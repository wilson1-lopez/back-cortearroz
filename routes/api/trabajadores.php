<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrabajadorController;
use App\Http\Middleware\JwtMiddleware;

Route::middleware([JwtMiddleware::class])->group(function () {
    // Rutas específicas adicionales - DEBEN IR ANTES de apiResource
    Route::get('/trabajadores/trabajadoresusuario', [TrabajadorController::class, 'getByUsuario']);
    Route::get('/trabajadores/tipo/{tipoId}', [TrabajadorController::class, 'getByTipo']);
    Route::post('/trabajadores/buscar', [TrabajadorController::class, 'searchByName']);
    Route::get('/trabajadores/cedula/{cedula}', [TrabajadorController::class, 'getByCedula']);
    
    // CRUD básico con apiResource - definiendo explícitamente el parámetro
    Route::apiResource('trabajadores', TrabajadorController::class)->parameter('trabajadores', 'trabajador');
});
