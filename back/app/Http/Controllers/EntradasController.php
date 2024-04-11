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
                'precio' => $entrada['precio'],
                'email' => $entradasData['email'] // Acceder al correo electrónico desde $entradasData
            ]);
            // Luego de guardar cada entrada, envía el correo electrónico

            $butacasSeleccionadas[] =[
                'butaca' => $nuevaEntrada -> Butaca,
                'precio' => $nuevaEntrada -> precio
            ];
            
        }

        $datosCorreo = [
            'sesion_cine_id' => $nuevaEntrada->sesion_cine_id,
            'Butaca' => $butacasSeleccionadas,
            'email' => $nuevaEntrada->email,
            'precioTotal' =>  array_sum(array_column($butacasSeleccionadas, 'precio'))
        ];



        Mail::to($datosCorreo['email'])->send(new enviarCorreo($datosCorreo));

        return response()->json(['message' => 'Entradas guardadas correctamente'], 201);
    }

    public function show($id)
    {
        $entrada = Entradas::with('Sessions')->findOrFail($id);
        return response()->json($entrada);
    }
}
