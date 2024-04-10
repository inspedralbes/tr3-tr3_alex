<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entradas;
use App\Models\Sessions;

class EntradasController extends Controller
{
    public function index()
    {
        $entradas = Entradas::with('Sessions')->get();
        return response()->json($entradas);
    }

    public function store(Request $request)
    {
        $entradasData = $request->json()->all();

        foreach ($entradasData['asientos'] as $entrada) {
            $nuevaEntrada = Entradas::create([
                'sesion_cine_id' => $entrada['sesion_cine_id'],
                'Butaca' => $entrada['Butaca'],
                'Fila' => $entrada['Fila'],
                'Asiento' => $entrada['Asiento']
            ]);
        }

        return response()->json(['message' => 'Entradas guardadas correctamente'], 201);
    }

    public function show($id)
    {
        $entrada = Entradas::with('Sessions')->findOrFail($id);
        return response()->json($entrada);
    }
}
