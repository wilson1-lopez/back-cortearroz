<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemporadaController;
use App\Http\Middleware\JwtMiddleware;

Route::middleware([JwtMiddleware::class])->group(function () {
    // Rutas específicas adicionales - DEBEN IR ANTES de apiResource
    Route::get('/temporadas/usuario', [TemporadaController::class, 'getByUsuario']);
    Route::post('/temporadas/rango', [TemporadaController::class, 'getEnRango']);
    Route::post('/temporadas/buscar', [TemporadaController::class, 'searchByName']);
    
    // CRUD básico con apiResource - definiendo explícitamente el parámetro
    Route::apiResource('temporadas', TemporadaController::class)->parameter('temporadas', 'temporada');
});
