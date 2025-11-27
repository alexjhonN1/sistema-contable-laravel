<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planilla;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\PlanillaDetalle;
use Barryvdh\DomPDF\Facade\Pdf;


class PlanillaController extends Controller
{
    // LISTAR PLANILLAS
    public function index()
    {
        $planillas = Planilla::with('cliente')->orderBy('id','desc')->get();
        $clientes = Cliente::all();

        return view('planillas.index', compact('planillas', 'clientes'));
    }

    // GENERAR PLANILLA
    public function generar(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required',
            'mes'        => 'required',
        ]);

        // Crear planilla
        $planilla = Planilla::create([
            'cliente_id' => $request->cliente_id,
            'mes'        => $request->mes,
        ]);

        $empleados = Empleado::where('cliente_id', $request->cliente_id)->get();

        foreach ($empleados as $e) {

            // CLASIFICADOR
            $tipo = $e->tipo;

            // CÁLCULOS BÁSICOS
            $ingresos   = $e->sueldo;
            $aporteTrab = $ingresos * 0.13; // ONP simple
            $neto       = $ingresos - $aporteTrab;
            $aporteEmp  = $ingresos * 0.09; // Essalud

            PlanillaDetalle::create([
                'planilla_id'        => $planilla->id,
                'empleado_id'        => $e->id,
                'dias'               => 30,
                'ingresos'           => $ingresos,
                'descuentos'         => 0,
                'aporte_trabajador'  => $aporteTrab,
                'neto_pagar'         => $neto,
                'aporte_empleador'   => $aporteEmp,
                'tipo'               => $tipo,
            ]);
        }

        return redirect()->route('planillas.show', $planilla->id);
    }

    // MOSTRAR PLANILLA GENERADA
    public function show($id)
    {
        $planilla = Planilla::findOrFail($id);
        $detalles = $planilla->detalles()->with('empleado')->get();

        return view('planillas.show', compact('planilla','detalles'));
    }

    // EDITAR DETALLE
    public function editarDetalle($id)
    {
        $detalle = PlanillaDetalle::with('empleado')->findOrFail($id);
        return view('planillas.edit-detalle', compact('detalle'));
    }

    // ACTUALIZAR DETALLE
 public function actualizarDetalle(Request $request, $id)
{
    $detalle = PlanillaDetalle::findOrFail($id);

    $dias = $request->dias;
    $ingresos = $request->ingresos;

    // Cálculo automático del descuento por días no trabajados
    $sueldo_diario = $ingresos / 30;
    $dias_no_trabajados = 30 - $dias;

    $descuento_automatico = 0;
    if ($dias_no_trabajados > 0) {
        $descuento_automatico = $sueldo_diario * $dias_no_trabajados;
    }

    // Se suma a los descuentos ingresados manualmente
    $descuentos_finales = $request->descuentos + $descuento_automatico;

    // Aportes (puedes ajustar tus tasas)
    $aporte_trabajador = $ingresos * 0.13;  // Ejemplo AFP/ONP
    $aporte_empleador = $ingresos * 0.09;   // Ejemplo Essalud

    // NETO
    $neto = $ingresos - $descuentos_finales - $aporte_trabajador;

    // Guardar
    $detalle->update([
        'dias' => $dias,
        'ingresos' => $ingresos,
        'descuentos' => $descuentos_finales,
        'aporte_trabajador' => $aporte_trabajador,
        'aporte_empleador' => $aporte_empleador,
        'neto_pagar' => $neto
    ]);

    return redirect()
            ->route('planillas.show', $detalle->planilla_id)
            ->with('success', 'Detalle actualizado correctamente');
}

public function exportarPDF($id)
{
    $planilla = Planilla::with('cliente')->findOrFail($id);
    $detalles = PlanillaDetalle::with('empleado')
                    ->where('planilla_id', $id)
                    ->get();

    $pdf = PDF::loadView('planillas.pdf', compact('planilla', 'detalles'))
              ->setPaper('A4', 'portrait');

    return $pdf->download('Planilla_'.$planilla->mes.'.pdf');
}
public function historialPorEmpresa($id)
{
    $planillas = Planilla::where('cliente_id', $id)
        ->with('cliente')
        ->orderBy('id', 'desc')
        ->get();

    $cliente = Cliente::findOrFail($id);

    return view('planillas.historial', compact('planillas', 'cliente'));
}

}
