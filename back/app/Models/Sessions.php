<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    use HasFactory;

    protected $table = 'sessions';
    protected $fillable = [
        'pelicula_id',
        'fecha_hora',
        'tipo_sesion',
        'subtitulada',
        'precio',
        'precio_Vip',
        'Vip',
        
    ];

    public function pelicula()
    {
        return $this->belongsTo(Peliculas::class, 'pelicula_id');
    }

    public function entradas()
    {
        return $this->hasMany(Entrada::class, 'sesion_cine_id');
    }

    public function assignDates()
    {
        // Obtiene la fecha actual
        $fechaActual = now();

        // Asigna la fecha actual como fecha de la sesión actual
        $this->fecha_hora = $fechaActual;

        // Asigna la fecha de la sesión siguiente (5 días después)
        $this->fecha_siguiente = $fechaActual->addDays(5);

        // Guarda los cambios en la base de datos
        $this->save();
    }
}
