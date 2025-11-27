<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = [
        'cliente_id',
        'tipo',
        'tipo_documento',
        'numero_documento',
        'apellido_paterno',
        'apellido_materno',
        'nombres',
        'fecha_ingreso',
        'cargo',
        'sueldo',
        'pension',
        'asignacion_familiar',
    ];

    protected $casts = [
        'asignacion_familiar' => 'boolean'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function getNombreCompletoAttribute()
    {
        return "{$this->apellido_paterno} {$this->apellido_materno} {$this->nombres}";
    }
    public function detalles()
    {
    return $this->hasMany(PlanillaDetalle::class);
    }

}
