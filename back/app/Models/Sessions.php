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
        
    ];

    protected static function boot()
    {
        parent::boot();

        // Define el evento created
        static::created(function ($sesion) {
            // Lógica para asignar las fechas de las sesiones
            $sesion->assignDates();
        });
    }

    public function pelicula()
    {
        return $this->belongsTo(Pelicula::class, 'pelicula_id');
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
