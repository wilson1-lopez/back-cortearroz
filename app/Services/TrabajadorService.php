<?php

namespace App\Services;

use App\Repositories\Trabajador\Interfaces\TrabajadorRepositoryInterface;

class TrabajadorService
{
    public function __construct(
        protected TrabajadorRepositoryInterface $trabajadorRepository
    ) {
        $this->trabajadorRepository = $trabajadorRepository;
    }

    public function registrarTrabajador(array $data)
    {
        return $this->trabajadorRepository->create($data);
    }

    public function obtenerTrabajadores()
    {
        return $this->trabajadorRepository->all();
    }

    public function obtenerTrabajadorPorId($id)
    {
        return $this->trabajadorRepository->find($id);
    }

    public function actualizarTrabajador($id, array $data)
    {
        return $this->trabajadorRepository->update($id, $data);
    }

    public function eliminarTrabajador($id)
    {
        return $this->trabajadorRepository->delete($id);
    }

    public function obtenerTrabajadoresPorUsuario($usuarioId)
    {
        return $this->trabajadorRepository->getByUsuarioId($usuarioId);
    }

    public function obtenerTrabajadoresPorTipo($tipoId)
    {
        return $this->trabajadorRepository->getByTipoId($tipoId);
    }

    public function buscarTrabajadoresPorNombre($nombre)
    {
        return $this->trabajadorRepository->searchByName($nombre);
    }

    public function obtenerTrabajadorPorCedula($cedula)
    {
        return $this->trabajadorRepository->getByCedula($cedula);
    }
}
