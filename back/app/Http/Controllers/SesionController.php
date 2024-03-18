<?php

namespace App\Http\Controllers;

use App\Models\Sesion; // Asegúrate de importar el modelo de Sesion si aún no lo has hecho
use Illuminate\Http\Request;

class SesionController extends Controller
{
    // Método para mostrar todas las sesiones
    public function index()
    {
        $sesiones = Sesion::all();
        return response()->json($sesiones);
    }

    // Método para mostrar una sesión específica
    public function show($id)
    {
        $sesion = Sesion::find($id);
        return response()->json($sesion);
    }

    // Otros métodos para crear, actualizar y eliminar sesiones
}
