<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

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


    public function setClaveSolAttribute($value)
    {
        $this->attributes['clave_sol'] = $value ? encrypt($value) : null;
    }

    public function setPasswordSolAttribute($value)
    {
        $this->attributes['password_sol'] = $value ? encrypt($value) : null;
    }

    public function getClaveSolAttribute($value)
    {
        if (!$value) return null;

        // Si el valor NO está cifrado, lo devolvemos tal cual
        if (!str_starts_with($value, 'eyJ')) {
            return $value;
        }

        // Intentar descifrar
        try {
            return decrypt($value);
        } catch (\Exception $e) {
            return $value; // evitar error de payload inválido
        }
    }

    
    public function getPasswordSolAttribute($value)
    {
        if (!$value) return null;

        // Si el valor NO está cifrado, lo devolvemos tal cual
        if (!str_starts_with($value, 'eyJ')) {
            return $value;
        }

        // Intentar descifrar
        try {
            return decrypt($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
}
