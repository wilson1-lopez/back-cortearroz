<?php

namespace App\Repositories\Proveedor\Interfaces;

use App\Repositories\RepositoryInterface;

interface ProveedorRepositoyInterface extends RepositoryInterface
{
    public function obtenerProveedoresPorUsuario($id);
     public function actualizar($id, array $data); 
}


