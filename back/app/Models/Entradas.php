<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sessions;

class Entradas extends Model
{
    use HasFactory;

    protected $table = 'entradas';
    protected $fillable = [
        'sesion_cine_id',
        'Butaca',
        'Fila',
        'Asiento',
    ];

    public function sesion()
    {
        return $this->belongsTo(Sessions::class, 'sesion_cine_id');
    }
}