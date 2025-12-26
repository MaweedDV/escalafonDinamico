<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FuncionariosDataTable;
use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\CalidadJuridica;
use App\Models\CargosEscalafon;
use App\Models\Funcionarios;
use App\Models\NombresCargos;
use App\Models\Profesion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FuncionariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FuncionariosDataTable $dataTable)
    {
        $calidadJuridica = CalidadJuridica::all();
        $estado = Funcionarios::select('estado')->distinct()->get();
        $educacionFormal = Profesion::all();
        $cargosEscalafon = CargosEscalafon::join('nombres_cargos', 'cargos_escalafons.Id_nombresCargos', '=', 'nombres_cargos.id')
            ->select('cargos_escalafons.*', 'nombres_cargos.nombre_cargo as nombreCargo')->where('cargos_escalafons.asignado', 0)
            ->get();



        return $dataTable->render('backend.sections.funcionarios.index', compact('calidadJuridica', 'cargosEscalafon', 'estado','educacionFormal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (Funcionarios::where('rut', $request->rut)->exists()) {

            return to_route('funcionarios.index')->with('error', 'Porfavor ingrese un RUT válido que no esté registrado en el sistema.');

        }else if ($request->rut == null || $request->nombre == null) {

            return to_route('funcionarios.index')->with('error', 'Hay campos obligatorios que no han sido completados.');

        }else if ($request->cargoEscalafon == null) {

            return to_route('funcionarios.index')->with('error', 'Debe seleccionar un cargo del escalafón disponible.');

        } else {
            $funcionarios = Funcionarios::create([
                'decreto' => $request->decreto,
                'fecha_decreto' => $request->fechaDecreto,
                'rut' => $request->rut,
                'nombre' => $request->nombre,
                'apellido_paterno' => $request->apellidoPaterno,
                'apellido_materno' => $request->apellidoMaterno,
                'id_Cargo' => $request->cargoEscalafon,
                'calificacion' => 0,
                'lista' => 1,
                'antiguedad_cargo' => $request->ant_cargo,
                'antiguedad_grado' => $request->ant_grado,
                'antiguedad_mismo_municipio' => $request->ant_mism_mun,
                'antiguedad_mismo_municipio_detalle' => $request->ant_mism_mun_detalle,
                'antiguedad_administracion_estado' => $request->ant_administracion_estado,
                'educacion_formal' => $request->educacionFormal,
                'estado' => 'vigente',
            ]);

            $cargo = CargosEscalafon::find($request->cargoEscalafon);

            $cargo->update([
                'asignado' => 1,
            ]);

            if ($funcionarios instanceof Model) {

                return to_route('funcionarios.index')->with('success', 'Registro creado exitosamente!');

            }

        }

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
        $funcionario = Funcionarios::find($id);
        $calidadJuridica = CalidadJuridica::all();
        $cargosEscalafon = CargosEscalafon::join('nombres_cargos', 'cargos_escalafons.Id_nombresCargos', '=', 'nombres_cargos.id')
            ->select('cargos_escalafons.*', 'nombres_cargos.nombre_cargo as nombreCargo')->where('cargos_escalafons.asignado', 0)->get();
        $educacionFormal = Profesion::all();
        $cargos = CargosEscalafon::find($funcionario->id_Cargo);
        $nombresCargos = NombresCargos::find($cargos->Id_nombresCargos);



        return view('backend.sections.funcionarios.edit', compact('nombresCargos', 'cargos', 'funcionario', 'calidadJuridica', 'cargosEscalafon', 'educacionFormal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {



         $funcionario = Funcionarios::find($id);
         $cargo = CargosEscalafon::find($funcionario->id_Cargo);



        if (in_array($request->Estado, ['desactivado','retirado','fallecido'])) {

            $funcionario->update([
                'rut' => $request->rut,
                'nombre' => $request->nombre,
                'apellido_paterno' => $request->apellidoPaterno,
                'apellido_materno' => $request->apellidoMaterno,
                'id_Cargo' => null, // 👈 CLAVE
                'antiguedad_cargo' => $request->ant_cargo,
                'antiguedad_grado' => $request->ant_grado,
                'antiguedad_mismo_municipio' => $request->ant_mism_mun,
                'antiguedad_mismo_municipio_detalle' => $request->ant_mism_mun_detalle,
                'antiguedad_administracion_estado' => $request->ant_administracion_estado,
                'educacion_formal' => $request->educacionFormal,
                'estado' => $request->Estado,
            ]);

            if ($cargo) {
                $cargo->update(['asignado' => 0]);
            }

        }else if ($request->Estado === 'vigente' && $request->filled('cargoEscalafon')) {

                 if ($cargo) {
                    $cargo->update(['asignado' => 0]);
                }

                $funcionario->update([
                    'rut' => $request->rut,
                    'nombre' => $request->nombre,
                    'apellido_paterno' => $request->apellidoPaterno,
                    'apellido_materno' => $request->apellidoMaterno,
                    'id_Cargo' => $request->cargoEscalafon,
                    'antiguedad_cargo' => $request->ant_cargo,
                    'antiguedad_grado' => $request->ant_grado,
                    'antiguedad_mismo_municipio' => $request->ant_mism_mun,
                    'antiguedad_mismo_municipio_detalle' => $request->ant_mism_mun_detalle,
                    'antiguedad_administracion_estado' => $request->ant_administracion_estado,
                    'educacion_formal' => $request->educacionFormal,
                    'estado' => $request->Estado,
                ]);



                $newCargo = CargosEscalafon::find($request->cargoEscalafon);
                if ($newCargo) {
                    $newCargo->update(['asignado' => 1]);
                }

        }else if($request->Estado === 'vigente' && !$request->filled('cargoEscalafon')) {

            $funcionario->update([
                'rut' => $request->rut,
                'nombre' => $request->nombre,
                'apellido_paterno' => $request->apellidoPaterno,
                'apellido_materno' => $request->apellidoMaterno,
                'antiguedad_cargo' => $request->ant_cargo,
                'antiguedad_grado' => $request->ant_grado,
                'antiguedad_mismo_municipio' => $request->ant_mism_mun,
                'antiguedad_mismo_municipio_detalle' => $request->ant_mism_mun_detalle,
                'antiguedad_administracion_estado' => $request->ant_administracion_estado,
                'educacion_formal' => $request->educacionFormal,
                'estado' => $request->Estado,
            ]);
        }


        if ($funcionario instanceof Model) {

            return to_route('funcionarios.index')->with('success', 'Registro actualizado exitosamente!');

        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $id = decrypt($id);

        $funcionario = Funcionarios::findOrFail($id);

        if ($funcionario instanceof Model) {
            $funcionario->delete();

            //toastr()->warning('Data has been deleted successfully!');

            return to_route('users.index')->with('flash', 'Registro eliminado exitosamente!');
        }
    }
}
