<?php

namespace App\Http\Controllers;

use App\Models\LibroSunat;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteDiaExport;

class ReporteController extends Controller
{
    /* ============================================================
        VISTA PRINCIPAL DEL REPORTE DEL DÍA
    ============================================================ */
    public function index()
    {
        $hoy = Carbon::today();

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

        return view('reportes.index', [
            'totalLibrosHoy' => $totalLibrosHoy,
            'enviadosHoy' => $enviadosHoy,
            'pendientesHoy' => $pendientesHoy,
            'observadosHoy' => $observadosHoy,
            'clientesAtendidos' => $clientesAtendidos,
            'detalle' => $detalle,
            'hoy' => $hoy->format('d/m/Y')
        ]);
    }

    /* ============================================================
        EXPORTAR A PDF
    ============================================================ */
    public function pdf()
    {
        $hoy = Carbon::today();

        $detalle = LibroSunat::with(['cliente', 'usuario'])
            ->whereDate('created_at', $hoy)
            ->get();

        $data = [
            'hoy' => $hoy->format('d/m/Y'),
            'detalle' => $detalle
        ];

        $pdf = PDF::loadView('reportes.pdf', $data);

        return $pdf->download('Reporte_del_dia.pdf');
    }

}
