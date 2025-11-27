<?php

namespace App\Http\Controllers;

use App\Models\LibroSunat;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index()
    {
        // Fecha de hoy
        $hoy = now()->toDateString();

        // Resumen general
        $totalLibrosHoy = LibroSunat::whereDate('created_at', $hoy)->count();
        $enviadosHoy = LibroSunat::whereDate('created_at', $hoy)->where('estado', 'enviado')->count();
        $pendientesHoy = LibroSunat::whereDate('created_at', $hoy)->where('estado', 'pendiente')->count();
        $observadosHoy = LibroSunat::whereDate('created_at', $hoy)->where('estado', 'observado')->count();

        // Clientes atendidos hoy
        $clientesAtendidos = LibroSunat::whereDate('created_at', $hoy)
            ->distinct('cliente_id')
            ->count('cliente_id');

        // Detalle del día
        $detalle = LibroSunat::with(['cliente', 'usuario'])
            ->whereDate('created_at', $hoy)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('reportes.index', compact(
            'totalLibrosHoy',
            'enviadosHoy',
            'pendientesHoy',
            'observadosHoy',
            'clientesAtendidos',
            'detalle',
            'hoy'
        ));
    }
}
