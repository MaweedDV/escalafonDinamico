<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CargosEscalafon;
use App\Models\NombresCargos;
use App\Models\Profesion;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;


class EscalafonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    // Traemos todos los nombres de cargos con sus cargos escalafón ordenados por grado,
    // y a su vez cargamos los funcionarios relacionados a cada cargo
    $nombresCargos = NombresCargos::with(['cargos_escalafon' => function ($query) {

        $query->orderBy('grado')->with('funcionarios');

    }])->orderBy('orden')->get();

    // dd($nombresCargos->toArray());
    $profesiones = Profesion::all();

    return view('backend.sections.escalafon.index', compact('nombresCargos'));

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



       $pdf = Pdf::loadView('backend.sections.escalafon.reportPDF', compact('nombresCargos'))
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
