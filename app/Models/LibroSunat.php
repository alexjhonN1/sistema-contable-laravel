<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibroSunat extends Model
{
    use HasFactory;

    protected $table = 'libros_sunat'; // ← FIX

    protected $fillable = [
        'cliente_id',
        'tipo_libro',
        'periodo',
        'estado',
        'archivo',
        'observaciones',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
