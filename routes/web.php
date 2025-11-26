<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

Route::get('/superadmin', function () {
    return "Bienvenido SuperAdmin";
})->middleware(['auth', 'rol:superadmin']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'rol:superadmin'])->name('dashboard');

Route::middleware(['auth', 'rol:SuperAdmin'])->group(function () {
    Route::resource('roles', RoleController::class);
});

Route::middleware(['auth', 'rol:SuperAdmin'])->group(function () {
    Route::resource('usuarios', UserController::class);
});

Route::resource('roles', RolesController::class)
    ->middleware(['auth', 'rol:superadmin']);
