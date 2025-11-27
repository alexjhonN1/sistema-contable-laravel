<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanillaDetalle extends Model
{
    protected $fillable = [
        'planilla_id',
        'empleado_id',
        'dias',
        'ingresos',
        'descuentos',
        'aporte_trabajador',
        'neto_pagar',
        'aporte_empleador',
        'tipo'
    ];

    public function planilla()
    {
        return $this->belongsTo(Planilla::class);
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}
