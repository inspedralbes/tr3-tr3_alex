<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    use HasFactory;

    protected $table = 'sesiones_cine';
    protected $fillable = [
        'pelicula_id',
        'fecha_hora',
        'asientos_disponibles',
        'tipo_sesion',
        'subtitulada',
        // 'precio', si decides mantener el precio aquí por alguna razón
    ];

    public function pelicula()
    {
        return $this->belongsTo(Pelicula::class, 'pelicula_id');
    }

    public function entradas()
    {
        return $this->hasMany(Entrada::class, 'sesion_cine_id');
    }
}
