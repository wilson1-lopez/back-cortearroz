<?php

use App\Http\Controllers\MaquinaController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Route;

//Route::apiResource('maquinas', MaquinaController::class);
//Route::get('/maquinas', [MaquinaController::class, 'ObtenerMaquinas']);

//obtener maquina con usuario
//Route::get('/maquinasusuario/{id}', [MaquinaController::class, 'obtenerMaquinaConUsuario']);


Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('/maquinasusuario', [MaquinaController::class, 'obtenerMaquinaConUsuario']);
    Route::apiResource('maquinas', MaquinaController::class);
});




