<?php

use App\Http\Controllers\AccionMantenimientoController;
use App\Http\Controllers\MantenimientoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('accionmantenimientos', AccionMantenimientoController::class);


Route::get('/usuarios/{usuario}/maquinas/{maquina}/acciones', [AccionMantenimientoController::class, 'accionesPorMaquinaYUsuario']);

