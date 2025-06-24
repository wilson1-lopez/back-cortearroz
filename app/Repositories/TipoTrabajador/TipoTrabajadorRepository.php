<?php

namespace App\Repositories\TipoTrabajador;

use App\Models\TipoTrabajador;
use App\Repositories\TipoTrabajador\Interfaces\TipoTrabajadorRepositoryInterface;

class TipoTrabajadorRepository implements TipoTrabajadorRepositoryInterface
{
    protected $model;

    public function __construct(TipoTrabajador $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->orderBy('nombre', 'asc')->get();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $tipoTrabajador = $this->find($id);
        if ($tipoTrabajador) {
            $tipoTrabajador->update($data);
            return $tipoTrabajador;
        }
        return null;
    }

    public function delete($id)
    {
        $tipoTrabajador = $this->find($id);
        if ($tipoTrabajador) {
            return $tipoTrabajador->delete();
        }
        return false;
    }

    public function findByNombre(string $nombre)
    {
        return $this->model->where('nombre', 'like', '%' . $nombre . '%')->get();
    }
}
