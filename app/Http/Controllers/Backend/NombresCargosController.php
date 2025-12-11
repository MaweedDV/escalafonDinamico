<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\NombresCargosDataTable;
use App\Http\Controllers\Controller;
use App\Models\NombresCargos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class NombresCargosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(NombresCargosDataTable $dataTable)
    {
        return $dataTable->render('backend.sections.nombresCargos.index');
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
        $nombreCargo = NombresCargos::create([
            'nombre_cargo' => $request->nombreCargo,
        ]);

        if ($nombreCargo instanceof Model) {

            return to_route('nombresCargos.index')->with('success', 'Registro creado exitosamente!');

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
        $nombreCargo = NombresCargos::find($id);

        return view('backend.sections.nombresCargos.edit', compact ('nombreCargo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $nombreCargo = NombresCargos::find($id);

        $nombreCargo->update([
            'nombre_cargo' => $request->nombreCargo,
        ]);

        if ($nombreCargo instanceof Model) {

            return to_route('nombresCargos.index')->with('success', 'Registro actualizado exitosamente!');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            $id = $id;

            $nombreCargo = NombresCargos::findOrFail($id);

            if ($nombreCargo instanceof Model) {

                $nombreCargo->delete();

                return to_route('nombresCargos.index')->with('success', 'Registro eliminado exitosamente!');
            }
    }
}
