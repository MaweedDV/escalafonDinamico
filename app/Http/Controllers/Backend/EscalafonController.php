<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CargosEscalafon;
use App\Models\EscalafonHistorico;
use App\Models\NombresCargos;
use App\Models\Profesion;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Database\Eloquent\Model;

class EscalafonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //configuracion de año para llenado de select en modal
        $ano_actual = date('Y');
        $ano_anterior = $ano_actual - 1;


        // Traemos todos los nombres de cargos con sus cargos escalafón ordenados por grado,
        // y a su vez cargamos los funcionarios relacionados a cada cargo
        $nombresCargos = NombresCargos::with(['cargos_escalafon' => function ($query) {

            $query->orderBy('grado')->with('funcionarios');

        }])->orderBy('orden')->get();

        // dd($nombresCargos->toArray());
        $profesiones = Profesion::all();

        return view('backend.sections.escalafon.index', compact('nombresCargos',  'ano_anterior'));

            // $nombresCargos = NombresCargos::with(['cargos_escalafon' => function ($query) {
            // $query->orderBy('grado');
            //     }])
            //     ->orderBy('orden')
            //     ->get();

    }

    public function ordenarEscalafon(){

         $elementos = NombresCargos::orderBy('orden')->get();


         return view('backend.sections.escalafon.ordenarEscalafon', compact('elementos'));


    }


    public function guardarOrden(Request $request)
    {
        foreach ($request->orden as $item) {
            NombresCargos::where('id', $item['id'])->update(['orden' => $item['orden']]);
        }

        return response()->json(['status' => 'ok']);
        return view('backend.sections.escalafon.escalafon')->with('success', 'Orden guardada exitosamente!');
    }

    public function escalafonPDF()
    {
        $nombresCargos = NombresCargos::with(['cargos_escalafon' => function ($query) {

            $query->orderBy('grado')->with('funcionarios');

        }])->orderBy('orden')->get();

        $profesiones = Profesion::all();

            $ano_actual = date('Y');
            $ano_vigencia = $ano_actual + 1;

            $ano_periodo_desde = $ano_vigencia - 2;
            $ano_periodo_hasta = $ano_vigencia - 1;

       $pdf = Pdf::loadView('backend.sections.escalafon.reportPDF', compact('nombresCargos', 'ano_periodo_desde', 'ano_periodo_hasta', 'ano_vigencia'))
          ->setPaper('A4', 'landscape');

        // Renderiza primero
        $pdf->render();

        // Luego agrega la numeración de página
        $pdf->getDomPDF()->get_canvas()->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
            $text = "pág. $pageNumber";
            $font = $fontMetrics->getFont("Helvetica", "normal");
            $size = 9;
            $width = $fontMetrics->getTextWidth($text, $font, $size);

            // alineación derecha
            $x = $canvas->get_width() - $width - 100; // margen derecho
            $y = $canvas->get_height() - 50; // margen inferior
            $canvas->text($x, $y, $text, $font, $size);
        });

        // Finalmente envía el PDF
        return $pdf->stream('escalafon.pdf');
    }

    public function escalafonConfirmado(request $request)
    {
        $nombresCargos = NombresCargos::with(['cargos_escalafon' => function ($query) {
            $query->orderBy('grado')->with('funcionarios');
        }])->orderBy('orden')->get();

        $escalafonesExistentes = EscalafonHistorico::where('ano', $request->ano_escalafon)->count();

        if ($escalafonesExistentes > 0) {
            return to_route('escalafon.index')->with('error', 'Ya existen registros para el año seleccionado.');
        }else{
              $ano_periodo_desde = $request->ano_escalafon - 2;
              $ano_periodo_hasta = $request->ano_escalafon - 1;

            foreach ($nombresCargos as $nombreCargo) {

                // Agrupamos cargos escalafón por grado
                $cargosPorGrado = $nombreCargo->cargos_escalafon->groupBy('grado');

                foreach ($cargosPorGrado as $grado => $cargos) {

                    // Aplanamos y ordenamos todos los funcionarios de este grupo
                    $funcionarios = $cargos->flatMap->funcionarios->sortBy([
                        ['calificacion', 'desc'],
                        ['antiguedad_cargo', 'asc'],
                        ['antiguedad_grado', 'asc'],
                        ['antiguedad_mismo_municipio', 'asc'],
                        ['fecha_decreto', 'asc'],
                        ['decreto', 'asc'],
                    ]);

                    // Contamos la cantidad de cargos disponibles en este grado
                    $totalCargos = $cargos->count();
                    $totalFuncionarios = $funcionarios->count();

                    $posicion = 0;

                    // 🔹 Primero creamos los registros de funcionarios
                    foreach ($funcionarios as $funcionario) {
                        $posicion++;

                        EscalafonHistorico::create([
                            'id_funcionario' => $funcionario->id,
                            'ano' => $request->ano_escalafon,
                            'periodo_desde' => $ano_periodo_desde.'-09-01',
                            'periodo_hasta' => $ano_periodo_hasta.'-08-31',
                            'posicion' => $posicion,
                            'id_cargo' => $funcionario->id_Cargo, // cargo escalafón real
                            'calificacion' => $funcionario->calificacion,
                            'lista' => $funcionario->lista,
                        ]);
                    }

                    // 🔹 Luego agregamos los cargos vacantes (si hay más cupos que funcionarios)
                    $vacantes = $totalCargos - $totalFuncionarios;

                    for ($i = 1; $i <= $vacantes; $i++) {
                        $posicion++;

                        EscalafonHistorico::create([
                            'id_funcionario' => 0, // sin funcionario asignado
                            'ano' => $request->ano_escalafon,
                            'periodo_desde' => $ano_periodo_desde.'-09-01',
                            'periodo_hasta' => $ano_periodo_hasta.'-08-31',
                            'posicion' => $posicion,
                            'id_cargo' => $funcionario->id_Cargo,
                            'calificacion' => 0,
                            'lista' => 0,
                        ]);
                    }
                }
            }

            return to_route('escalafon.index')->with('success', 'Registros creados exitosamente!');
        }


    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
