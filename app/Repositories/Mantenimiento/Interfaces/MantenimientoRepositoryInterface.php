<?php

namespace App\Repositories\Mantenimiento\Interfaces;

use App\Repositories\RepositoryInterface;    

interface MantenimientoRepositoryInterface extends RepositoryInterface {
    public function obtenerMantenimientosPorMaquinaId($id);
}