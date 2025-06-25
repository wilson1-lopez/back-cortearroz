<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoTrabajadorController;
use App\Http\Middleware\JwtMiddleware;

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::prefix('tipos-trabajadores')->group(function () {
        Route::get('/', [TipoTrabajadorController::class, 'index']);
        Route::post('/', [TipoTrabajadorController::class, 'store']);
        Route::get('/search', [TipoTrabajadorController::class, 'search']);
        Route::get('/{id}', [TipoTrabajadorController::class, 'show']);
        Route::put('/{id}', [TipoTrabajadorController::class, 'update']);
        Route::delete('/{id}', [TipoTrabajadorController::class, 'destroy']);
    });
});
