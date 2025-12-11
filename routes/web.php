<?php

use App\Http\Controllers\Backend\CalificacionController;
use App\Http\Controllers\Backend\CargosEscalafon;
use App\Http\Controllers\Backend\EscalafonController;
use App\Http\Controllers\Backend\FuncionariosController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController as FrontEndHomeController;
use App\Http\Controllers\Backend\HomeController as BackEndHomeController;
use App\Http\Controllers\Backend\NombresCargosController;
use App\Http\Controllers\Backend\ProfesionesController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\EscalafonControllerFront;
use App\Models\NombresCargos;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

Auth::routes();

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [BackEndHomeController::class, 'index'])->name('dashboard');

    //ESCALAFON
    Route::group(['prefix' => 'escalafon'], function () {
        Route::get('/', [EscalafonController::class, 'index'])->name('escalafon.index');
        Route::get('/ordenar', [EscalafonController::class, 'ordenarEscalafon'])->name('escalafon.ordenar');
        Route::post('/orden', [EscalafonController::class, 'guardarOrden']);
        Route::get('/pdf', [EscalafonController::class, 'escalafonPDF'])->name('escalafonPDF.report');
        Route::post('/generar-escalafon', [EscalafonController::class, 'escalafonConfirmado'])->name('escalafon.generar');
    });


    // Users
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
        Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
    });


    //NOMBRES CARGOS
    Route::group(['prefix' => 'NombresCargos'], function () {
        Route::get('/', [NombresCargosController::class, 'index'])->name('nombresCargos.index');
        Route::post('/', [NombresCargosController::class, 'store'])->name('nombresCargos.store');
        Route::get('/edit/{id}', [NombresCargosController::class, 'edit'])->name('nombresCargos.edit');
        Route::delete('/{id}', [NombresCargosController::class, 'destroy'])->name('nombresCargos.destroy');
        // Route::get('/{id}', [NombresCargosController::class, 'show'])->name('nombresCargos.show');
        Route::put('/{id}', [NombresCargosController::class, 'update'])->name('nombresCargos.update');
    });

    //PROFESIONES
    Route::group(['prefix' => 'Profesiones'], function () {
        Route::get('/', [ProfesionesController::class, 'index'])->name('profesiones.index');
        Route::post('/', [ProfesionesController::class, 'store'])->name('profesiones.store');
        Route::get('/edit/{id}', [ProfesionesController::class, 'edit'])->name('profesiones.edit');
        Route::delete('/{id}', [ProfesionesController::class, 'destroy'])->name('profesiones.destroy');
        // Route::get('/{id}', [NombresCargosController::class, 'show'])->name('nombresCargos.show');
        Route::put('/{id}', [ProfesionesController::class, 'update'])->name('profesiones.update');
    });


    //CARGOS ESCALAFON
    Route::group(['prefix' => 'cargosEscalafon'], function () {
        Route::get('/', [CargosEscalafon::class, 'index'])->name('cargosEscalafon.index');
        Route::post('/', [CargosEscalafon::class, 'store'])->name('cargosEscalafon.store');
        //Route::get('/edit/{id}', [CargosEscalafon::class, 'edit'])->name('cargosEscalafon.edit');
        // Route::delete('/{id}', [CargosEscalafon::class, 'destroy'])->name('cargosEscalafon.destroy');
        // Route::get('/{id}', [CargosEscalafon::class, 'show'])->name('cargosEscalafon.show');
        // Route::put('/{id}', [CargosEscalafon::class, 'update'])->name('cargosEscalafon.update');
    });

    //FUNCIONARIOS
    Route::group(['prefix' => 'funcionarios'], function () {
        Route::get('/', [FuncionariosController::class, 'index'])->name('funcionarios.index');
        Route::post('/', [FuncionariosController::class, 'store'])->name('funcionarios.store');
        Route::get('/edit/{id}', [FuncionariosController::class, 'edit'])->name('funcionarios.edit');
        Route::delete('/{id}', [FuncionariosController::class, 'destroy'])->name('funcionarios.destroy');
        // Route::get('/{id}', [FuncionariosController::class, 'show'])->name('funcionarios.show');
        Route::put('/{id}', [FuncionariosController::class, 'update'])->name('funcionarios.update');
    });


    //CALIFICACIONES
    Route::group(['prefix' => 'calificaciones'], function () {
        Route::get('/', [CalificacionController::class, 'index'])->name('calificacion.index');
        //Route::post('/', [CalificacionController::class, 'store'])->name('calificaciones.store');
        Route::post('/update-campo', [CalificacionController::class, 'updateCampo'])->name('calificaciones.updateCampo');
        // Route::get('/edit/{id}', [CalificacionController::class, 'edit'])->name('calificaciones.edit');
        // Route::delete('/{id}', [CalificacionController::class, 'destroy'])->name('calificaciones.destroy');
        // Route::get('/{id}', [CalificacionController::class, 'show'])->name('calificaciones.show');
        // Route::put('/{id}', [CalificacionController::class, 'update'])->name('calificaciones.update');
    });




});


Route::middleware(['auth', 'role:usuario'])->prefix('usuario')->group(function () {
    Route::get('/inicio', [BackEndHomeController::class, 'index'])->name('inicio');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.public.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.public.store');
});

Route::group(['prefix' => 'people'], function () {
        Route::group(['prefix' => 'escalafon'], function () {
            // SURVEYS FRONTEND
            Route::get('/', [EscalafonControllerFront::class, 'index'])->name('escalafon.front.index');
            Route::get('/pdf', [EscalafonController::class, 'escalafonPDF'])->name('escalafonPDFpublic.report');
            //Route::post('/', [EscalafonControllerFront::class, 'store'])->name('surveys.front.store');
        });

});

Route::get('/', [FrontEndHomeController::class, 'index'])->name('papa');

