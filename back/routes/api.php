<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\EntradasController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/peliculas', [PeliculaController::class,'listarPeliculas']);
Route::get('/sesiones', [SesionController::class, 'index']);
Route::get('/sesiones/{id}', [SesionController::class, 'show']);
Route::get('/sesiones-entradas/{id}', [SesionController::class, 'showEntradas']);
Route::get('/entradas', [EntradasController::class, 'index']);
Route::post('/entradas', [EntradasController::class, 'store']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
