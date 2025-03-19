<?php

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

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');

});

Route::middleware(['auth', 'role:customer'])->prefix('my-account')->group(function () {

});

Route::get('/', [FrontEndHomeController::class, 'index'])->name('home');

