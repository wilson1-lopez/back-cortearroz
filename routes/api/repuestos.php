<?php


use App\Http\Controllers\RepuestoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('repuestos', RepuestoController::class);