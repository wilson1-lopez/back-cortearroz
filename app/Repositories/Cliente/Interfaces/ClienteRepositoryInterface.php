<?php

namespace App\Repositories\Cliente\Interfaces;

use App\Repositories\RepositoryInterface;

interface ClienteRepositoryInterface extends RepositoryInterface
{
    public function obtenerClientesPorUsuario($usuarioId);
}
