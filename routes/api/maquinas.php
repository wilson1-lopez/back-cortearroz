<?php

use App\Http\Controllers\MaquinaController;
use Illuminate\Support\Facades\Route;

Route::apiResource('maquinas', MaquinaController::class);
//Route::get('/maquinas', [MaquinaController::class, 'ObtenerMaquinas']);








