<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\NombresCargos;
use App\Models\Profesion;
use Illuminate\Http\Request;

class EscalafonControllerFront extends Controller
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



        return view('frontend.sections.escalafon.escalafon', compact('nombresCargos'));
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
