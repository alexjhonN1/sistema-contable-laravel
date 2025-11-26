<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombre',
        'ruc',
        'dni',
        'clave_sol',
        'password_sol',
        'grupo',
        'estado',
    ];
}

