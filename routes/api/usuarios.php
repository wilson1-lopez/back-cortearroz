<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UsuarioController::class);

//obtener usuario con maquinas
Route::get('/usuariosmaquinas/{id}', [UsuarioController::class, 'obtenerUsuarioConMaquinas']);