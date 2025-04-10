<?php

namespace App\Services;

use App\Repositories\RepuestoProveedores\Interfaces\RepuestoProveedoresRepositoryInterface;

class RepuestoProveedoresService
{    
    public function __construct(protected RepuestoProveedoresRepositoryInterface $repuestoProveedoresRepository){}

    public function registrarRepuestoProveedores(array $data)
    {
        return $this->repuestoProveedoresRepository->create($data);
    }
}
