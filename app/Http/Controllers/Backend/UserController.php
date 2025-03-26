<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\CalidadJuridica;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {

        $calidadJuridica = CalidadJuridica::all();


        return $dataTable->render('backend.sections.users.index', compact('calidadJuridica'));
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



        // $this->validate($request, [
        //     'rut' => 'required|string|min:9|max:10',
        //     'nombre' => 'required|string|min:3|max:255',
        //     'apellido_paterno' => 'required|string|min:3|max:255',
        //     'apellido_materno' => 'required|string|min:3|max:255',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|string|min:8|max:255|confirmed',
        //     'password_confirmation' => 'required|string|min:8|max:255',
        // ]);

        if ($request->activo == null) {
                $user = User::create([
                    'rut' => $request->rut,
                    'nombre' => $request->nombre,
                    'apellido_paterno' => $request->apellidoPaterno,
                    'apellido_materno' => $request->apellidoMaterno,
                    'email' => $request->email,
                    'role' => $request->role,
                    'Id_calidad' => $request->calidadJuridica,
                    'password' => bcrypt($request->password),
                    'estado' => 0,
                ]);

                if ($user instanceof Model) {

                    return to_route('users.index')->with('success', 'Registro creado exitosamente!');

                }

        }else{
                $user = User::create([
                    'rut' => $request->rut,
                    'nombre' => $request->nombre,
                    'apellido_paterno' => $request->apellidoPaterno,
                    'apellido_materno' => $request->apellidoMaterno,
                    'email' => $request->email,
                    'role' => $request->role,
                    'Id_calidad' => $request->calidadJuridica,
                    'password' => bcrypt($request->password),
                    'estado' => $request->activo,
                ]);

                if ($user instanceof Model) {

                    return to_route('users.index')->with('success', 'Registro creado exitosamente!');

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
        $id = decrypt($id);

        $user = User::findOrFail($id);

        if ($user instanceof Model) {
            $user->delete();

            toastr()->warning('Data has been deleted successfully!');

            return to_route('users.index')->with('flash', 'Registro eliminado exitosamente!');
        }
    }
}
