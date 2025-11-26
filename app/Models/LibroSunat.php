<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibroSunat extends Model
{
    protected $fillable = [
        'cliente_id',
        'tipo_libro',
        'periodo',
        'estado',
        'archivo',
        'observaciones'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
