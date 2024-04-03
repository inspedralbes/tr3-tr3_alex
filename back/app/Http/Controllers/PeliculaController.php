<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Peliculas;

class PeliculaController extends Controller
{
    public function listarPeliculas()
    {
        $peliculas = Peliculas::all();
        

        return response()->json([
            'data' => $peliculas
        ]);
        
    }

    public function show($id)
    {
        $pelicula = Peliculas::findOrFail($id);
        return response()->json($pelicula);
    }
}
