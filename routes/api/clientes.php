<?php

use App\Http\Controllers\ClienteController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::apiResource('clientes', ClienteController::class);
    Route::get('/clientesusuario', [ClienteController::class, 'obtenerClientesPorUsuario']);
});
