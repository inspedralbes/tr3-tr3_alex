<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peliculas extends Model
{
    use HasFactory;

    protected $table = 'peliculas'; // Asegúrate de que el nombre de la tabla coincida con tu migración
    protected $fillable = [
        'titulo', // El nombre de la película
        'descripcion', // Una breve descripción o sinopsis de la película
        'anio_estreno', // El año en que la película fue o será estrenada
        'director', // El director de la película
        'duracion', // La duración de la película en minutos
        // Añade cualquier otra columna que tengas en tu tabla de películas
    ];

    // Si tienes relaciones definidas, como con sesiones o categorías, añádelas aquí
}
