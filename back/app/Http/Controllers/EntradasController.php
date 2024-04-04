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
        $entrada = Entradas::create($request->all());
        return response()->json($entrada, 201);
    }

    public function show($id)
    {
        $entrada = Entradas::with('Sessions')->findOrFail($id);
        return response()->json($entrada);
    }
}
