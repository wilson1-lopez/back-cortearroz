<?php

use App\Http\Controllers\MantenimientoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('mantenimientos', MantenimientoController::class);
Route::get('maquinas/{id}/mantenimientos-detalle', [App\Http\Controllers\MantenimientoController::class, 'detallePorMaquinaId']);

Route::post('/mantenimientos/completo', [MantenimientoController::class, 'storeCompleto']);

