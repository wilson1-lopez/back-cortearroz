<?php

namespace App\Services;

use App\Repositories\Mantenimiento\Interfaces\MantenimientoRepositoryInterface;

class MantenimientoService
{    
    public function __construct(protected MantenimientoRepositoryInterface $mantenimientoRepository){}

    public function registrarMantenimiento(array $data)
    {
        return $this->mantenimientoRepository->create($data);
    }
}
