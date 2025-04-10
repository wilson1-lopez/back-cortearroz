<?php

namespace App\Services;

use App\Repositories\RepuestoMantenimiento\Interfaces\RepuestoMantenimientoRepositoryInterface;

class RepuestoMantenimientoService
{    
    public function __construct(protected RepuestoMantenimientoRepositoryInterface $repuestoMantenimientoRepository){}

    public function registrarRepuestoMantenimiento(array $data)
    {
        return $this->repuestoMantenimientoRepository->create($data);
    }
}
