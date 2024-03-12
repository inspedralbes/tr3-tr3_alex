<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;

    protected $table = 'entradas';
    protected $fillable = [
        'sesion_cine_id',
        'cantidad',
        'precio',
    ];

    public function sesion()
    {
        return $this->belongsTo(Sesion::class, 'sesion_cine_id');
    }
}
