<?php

use App\Http\Controllers\MantenimientoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('mantenimientos', MantenimientoController::class);


