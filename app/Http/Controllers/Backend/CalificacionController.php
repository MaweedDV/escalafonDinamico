<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CalificacionDataTable;
use App\DataTables\NombresCargosDataTable;
use App\Http\Controllers\Controller;
use App\Models\Funcionarios;
use Illuminate\Http\Request;

class CalificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CalificacionDataTable $dataTable, NombresCargosDataTable $nombresCargosDataTable)
    {
        return $dataTable->render('backend.sections.calificaciones.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function updateCampo(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:funcionarios,id',
            'column' => 'required|in:calificacion',
            'value' => 'nullable|string',
        ]);

        $funcionario = Funcionarios::findOrFail($request->id);
        $funcionario->{$request->column} = $request->value;
        $funcionario->save();

        return response()->json(['success' => true]);
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
