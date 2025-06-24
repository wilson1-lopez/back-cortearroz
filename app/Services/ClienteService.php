<?php

namespace App\Services;

use App\Repositories\Cliente\Interfaces\ClienteRepositoryInterface;

class ClienteService
{
    public function __construct(protected ClienteRepositoryInterface $clienteRepository)
    {
    }

    public function registrarCliente(array $data)
    {
        return $this->clienteRepository->create($data);
    }

    public function obtenerTodosLosClientes()
    {
        return $this->clienteRepository->all();
    }

    public function obtenerClientePorId($id)
    {
        return $this->clienteRepository->find($id);
    }

    public function actualizarCliente($id, array $data)
    {
        return $this->clienteRepository->update($id, $data);
    }

    public function eliminarCliente($id)
    {
        return $this->clienteRepository->delete($id);
    }

    public function obtenerClientesPorUsuario($usuarioId)
    {
        return $this->clienteRepository->obtenerClientesPorUsuario($usuarioId);
    }
}
