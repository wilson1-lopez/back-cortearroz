<?php

namespace App\Services;

use App\Repositories\TipoTrabajador\Interfaces\TipoTrabajadorRepositoryInterface;

class TipoTrabajadorService
{
    public function __construct(
        protected TipoTrabajadorRepositoryInterface $tipoTrabajadorRepository
    ) {
        $this->tipoTrabajadorRepository = $tipoTrabajadorRepository;
    }

    public function obtenerTodos()
    {
        return $this->tipoTrabajadorRepository->all();
    }

    public function obtenerPorId($id)
    {
        return $this->tipoTrabajadorRepository->find($id);
    }

    public function registrarTipoTrabajador(array $data)
    {
        return $this->tipoTrabajadorRepository->create($data);
    }

    public function actualizarTipoTrabajador($id, array $data)
    {
        return $this->tipoTrabajadorRepository->update($id, $data);
    }

    public function eliminarTipoTrabajador($id)
    {
        return $this->tipoTrabajadorRepository->delete($id);
    }

    public function buscarPorNombre(string $nombre)
    {
        return $this->tipoTrabajadorRepository->findByNombre($nombre);
    }
}
