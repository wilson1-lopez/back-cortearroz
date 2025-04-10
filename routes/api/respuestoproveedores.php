<?php

use App\Http\Controllers\RepuestoProveedoresController;
use Illuminate\Support\Facades\Route;

Route::apiResource('repuestoproveedores', RepuestoProveedoresController::class);