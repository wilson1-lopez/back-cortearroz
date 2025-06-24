<?php

namespace App\Repositories\TipoTrabajador\Interfaces;

use App\Repositories\RepositoryInterface;

interface TipoTrabajadorRepositoryInterface extends RepositoryInterface
{
    public function findByNombre(string $nombre);
}
