<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CorteController;
use App\Http\Middleware\JwtMiddleware;



Route::middleware([JwtMiddleware::class])->group(function () {
    // Rutas específicas adicionales - DEBEN IR ANTES de apiResource
    Route::get('/cortes/cliente/{clienteId}', [CorteController::class, 'getByCliente']);
    Route::get('/cortes/temporada/{temporadaId}', [CorteController::class, 'getByTemporada']);
    Route::get('/cortes/activos', [CorteController::class, 'getActivos']);
    Route::post('/cortes/rango', [CorteController::class, 'getEnRango']);
    Route::post('/cortes/buscar', [CorteController::class, 'searchByDescripcion']);
    Route::get('/cortes/cliente/{clienteId}/temporada/{temporadaId}', [CorteController::class, 'getByClienteYTemporada']);
    
    // CRUD básico con apiResource - definiendo explícitamente el parámetro
    Route::apiResource('cortes', CorteController::class)->parameter('cortes', 'corte');
});
