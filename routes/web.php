<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LibroSunatController;


Route::get('/', function () {
    return view('welcome');
});


require __DIR__.'/auth.php';


Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'rol:superadmin'])->name('dashboard');


Route::get('/superadmin', function () {
    return "Bienvenido SuperAdmin";
})->middleware(['auth', 'rol:superadmin']);

Route::middleware(['auth', 'rol:superadmin'])->group(function () {
    Route::resource('roles', RolesController::class);
});

Route::middleware(['auth', 'rol:superadmin,admin'])->group(function () {
    Route::resource('usuarios', UserController::class);
});

Route::middleware(['auth', 'rol:superadmin,admin'])->group(function () {
    Route::resource('clientes', ClienteController::class);
});

Route::middleware(['auth', 'rol:superadmin,admin'])->group(function () {
    Route::resource('libros', LibroSunatController::class);
});
