<?php

namespace App\Repositories\Usuario\Interfaces;

use App\Models\User;
use App\Repositories\RepositoryInterface;

interface UsuarioRepositoryInterface extends RepositoryInterface
{
    public function obtenerUsuarioConMaquinas(int $id): ?User;

   
}
