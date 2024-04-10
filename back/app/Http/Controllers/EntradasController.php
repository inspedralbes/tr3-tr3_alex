<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entradas;
use App\Models\Sessions;
use App\Mail\enviarCorreo;
use Illuminate\Support\Facades\Mail;

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
                'Asiento' => $entrada['Asiento'],
                'email' => $entradasData['email'] // Acceder al correo electrónico desde $entradasData
            ]);
            // Luego de guardar cada entrada, envía el correo electrónico
            Mail::to($entradasData['email'])->send(new enviarCorreo());
        }
        return response()->json(['message' => 'Entradas guardadas correctamente'], 201);
    }

    public function show($id)
    {
        $entrada = Entradas::with('Sessions')->findOrFail($id);
        return response()->json($entrada);
    }
}
