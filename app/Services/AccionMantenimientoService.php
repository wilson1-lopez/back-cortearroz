<?php

namespace App\Services;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Repositories\AccionMantenimiento\Interfaces\AccionMantenimientoRepositoryInterface;

class AccionMantenimientoService
{    
    public function __construct(protected AccionMantenimientoRepositoryInterface $accionmantenimientoRepository){}

    public function registrarAccionMantenimiento(array $data)
    {
        return $this->accionmantenimientoRepository->create($data);
    }

    public function obtenerAccionesPorUsuarioYMaquina($usuarioId, $maquinaId)
    {
        try {
            return $this->accionmantenimientoRepository->obtenerAccionesPorUsuarioYMaquina($usuarioId, $maquinaId);
        } catch (ModelNotFoundException $e) {
            throw new \Exception("Máquina no encontrada o no pertenece al usuario");
        }
    }

}
