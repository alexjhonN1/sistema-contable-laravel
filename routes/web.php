<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LibroSunatController;
use App\Http\Controllers\ReporteController;


Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})
->middleware(['auth', 'rol:superadmin'])
->name('dashboard');

Route::get('/superadmin', function () {
    return "Bienvenido SuperAdmin";
})
->middleware(['auth', 'rol:superadmin']);

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

Route::middleware(['auth', 'rol:superadmin,admin'])->get('/consultas', function () {
    return view('consultas.index');
})->name('consultas.index');

Route::middleware(['auth', 'rol:superadmin,admin'])->group(function () {

    // Vista principal del reporte
    Route::get('/reportes', [ReporteController::class, 'index'])
        ->name('reportes.index');

    // Descargar PDF
    Route::get('/reportes/pdf', [ReporteController::class, 'pdf'])
        ->name('reportes.pdf');

    // Descargar Excel
    Route::get('/reportes/excel', [ReporteController::class, 'excel'])
        ->name('reportes.excel');
});
