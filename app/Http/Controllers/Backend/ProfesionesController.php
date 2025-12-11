<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProfesionDataTable;
use App\Http\Controllers\Controller;
use App\Models\Profesion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ProfesionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProfesionDataTable $dataTable)
    {
        return $dataTable->render('backend.sections.profesiones.index');
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
            $profesion = Profesion::create([
                'profesion' => $request->profesion,
            ]);

            return to_route('profesiones.index')->with('success', 'Profesión agregada exitosamente.');
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
        $profesion = Profesion::find($id);

        return view('backend.sections.profesiones.edit', compact('profesion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profesion = Profesion::find($id);

        $profesion->update([
                    'profesion' => $request->profesion,
        ]);

        if ($profesion instanceof Model) {

            return to_route('profesiones.index')->with('success', 'Profesión actualizada exitosamente.');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $id = $id;

        $profesion = Profesion::findOrFail($id);

        if ($profesion instanceof Model) {
            $profesion->delete();

            //toastr()->warning('Data has been deleted successfully!');

            return to_route('profesiones.index')->with('flash', 'Registro eliminado exitosamente!');
        }
    }
}
