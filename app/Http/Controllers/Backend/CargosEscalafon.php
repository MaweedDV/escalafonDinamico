<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CargosEscalafonDataTable;
use App\Http\Controllers\Controller;
use App\Models\CargosEscalafon as ModelsCargosEscalafon;
use App\Models\NombresCargos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CargosEscalafon extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CargosEscalafonDataTable $dataTable)
    {
        $nombresCargos = NombresCargos::all();

        $grados = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18);


        return $dataTable->render('backend.sections.cargosEscalafon.index', compact('nombresCargos', 'grados'));
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


        for ($i = 1; $i <= $request->cantidad_cargo; $i++) {
            $cargo = ModelsCargosEscalafon::create([
                'Id_nombresCargos' => $request->nombreCargo,
                'grado' => $request->grado,
                'asignado' => 0,
            ]);
        }

        if ($cargo instanceof Model) {

            return to_route('cargosEscalafon.index')->with('success', 'Registro creado exitosamente!');

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
