<?php


use App\Http\Controllers\RepuestoController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Route;



//agregamos el middleware
Route::middleware([JwtMiddleware::class])->group(function () {
    Route::apiResource('repuestos', RepuestoController::class);
    Route::get('/repuestosusuario', [RepuestoController::class, 'obtenerRepuestosPorUsuario']);
   
});