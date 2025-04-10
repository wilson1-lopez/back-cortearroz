<?php

namespace App\Repositories\AccionMantenimiento\Interfaces;

use App\Repositories\RepositoryInterface;    

interface AccionMantenimientoRepositoryInterface extends RepositoryInterface 
{
    public function obtenerAccionesPorUsuarioYMaquina(int $usuarioId, int $maquinaId);
 
}