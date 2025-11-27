<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LibroSunatController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PlanillaController;
use App\Http\Controllers\ReporteController;


Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

Route::get('/home', function () {
    return view('home');
})
->middleware('auth')
->name('home');

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

Route::middleware(['auth', 'rol:superadmin,admin'])->group(function () {
    Route::resource('empleados', EmpleadoController::class);
});

Route::middleware(['auth', 'rol:superadmin,admin'])->group(function () {

    // CRUD general
    Route::resource('planillas', PlanillaController::class);

    // Generar planilla
    Route::post('/planillas/generar', [PlanillaController::class, 'generar'])
        ->name('planillas.generar');

    // Editar detalle de un empleado
    Route::get('/planillas/detalle/{id}/editar', [PlanillaController::class, 'editarDetalle'])
        ->name('planillas.detalle.editar');

    // Actualizar detalle
    Route::put('/planillas/detalle/{id}/actualizar', [PlanillaController::class, 'actualizarDetalle'])
        ->name('planillas.detalle.actualizar');

    // Descargar PDF
    Route::get('/planillas/{id}/pdf', [PlanillaController::class, 'exportarPDF'])
        ->name('planillas.pdf');

    // Historial general
    Route::get('/planillas/historial', [PlanillaController::class, 'historial'])
        ->name('planillas.historial');

    // Historial por empresa
    Route::get('/planillas/historial/cliente/{id}', [PlanillaController::class, 'historialPorEmpresa'])
        ->name('planillas.historial.empresa');
});

Route::middleware(['auth', 'rol:superadmin,admin'])->get('/consultas', function () {
    return view('consultas.index');
})
->name('consultas.index');

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

