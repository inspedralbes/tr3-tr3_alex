<?php
namespace App\Http\Controllers;

use App\Models\Sessions;
use Illuminate\Http\Request;

class SesionController extends Controller
{
    // Método para mostrar todas las sesiones
    public function index()
    {
        $sesiones = Sessions::with('pelicula')->get();
        
        foreach ($sesiones as $sesion) {
            $butacasOcupadas = $sesion->butacas_ocupadas; 
            $butacasOcupadasArray = explode(',', $butacasOcupadas);
            $sesion->butacasOcupadas = $butacasOcupadasArray;
        }

        return response()->json($sesiones);
    }

    // Método para mostrar una sesión específica
    public function show($id)
    {
        $sesion = Sessions::with('pelicula')->findOrFail($id);
        return response()->json($sesion);
    }

    // Método para mostrar las entradas de una sesión específica
    public function showEntradas($id)
    {
        $sesion = Sessions::with('entradas')->findOrFail($id);
        return response()->json($sesion);
    }
}
