<?php

use App\Http\Controllers\Backend\EscalafonController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController as FrontEndHomeController;
use App\Http\Controllers\Backend\HomeController as BackEndHomeController;
use App\Http\Controllers\Backend\UserController;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

Auth::routes();

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [BackEndHomeController::class, 'index'])->name('dashboard');

    //ESCALAFON
    Route::get('/escalafon', [EscalafonController::class, 'index'])->name('escalafon.index');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');

});

Route::middleware(['auth', 'role:usuario'])->prefix('my-account')->group(function () {
    Route::get('/inicio', [BackEndHomeController::class, 'index'])->name('inicio');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
});

Route::get('/', [FrontEndHomeController::class, 'index'])->name('papa');

