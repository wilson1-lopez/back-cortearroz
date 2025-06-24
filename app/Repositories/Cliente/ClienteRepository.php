<?php

namespace App\Repositories\Cliente;

use App\Models\Cliente;
use App\Repositories\Cliente\Interfaces\ClienteRepositoryInterface;

class ClienteRepository implements ClienteRepositoryInterface
{
    public function all()
    {
        return Cliente::all();
    }

    public function find($id)
    {
        return Cliente::findOrFail($id);
    }

    public function create(array $data)
    {
        return Cliente::create($data);
    }

    public function update($id, array $data)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->update($data);
        return $cliente;
    }

    public function delete($id)
    {
        return Cliente::destroy($id);
    }

    public function obtenerClientesPorUsuario($usuarioId)
    {
        return Cliente::where('usuario_id', $usuarioId)->get();
    }
}
