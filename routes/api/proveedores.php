<?php

use App\Http\Controllers\ProveedorController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Route;



Route::middleware([JwtMiddleware::class])->group(function () {
    Route::apiResource('proveedores', ProveedorController::class);
    Route::get('/proveedoresusuario', [ProveedorController::class, 'obtenerProveedoresPorUsuario']);
});




