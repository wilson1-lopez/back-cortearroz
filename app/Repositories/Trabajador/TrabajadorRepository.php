<?php

namespace App\Repositories\Trabajador;

use App\Models\Trabajador;
use App\Repositories\Trabajador\Interfaces\TrabajadorRepositoryInterface;

class TrabajadorRepository implements TrabajadorRepositoryInterface
{
    public function __construct(protected Trabajador $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->with(['tipo', 'usuario'])->get();
    }

    public function find($id)
    {
        return $this->model->with(['tipo', 'usuario'])->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $trabajador = $this->find($id);
        if ($trabajador) {
            $trabajador->update($data);
            return $trabajador->fresh(['tipo', 'usuario']);
        }
        return null;
    }

    public function delete($id)
    {
        $trabajador = $this->find($id);
        if ($trabajador) {
            return $trabajador->delete();
        }
        return false;
    }

    public function getByUsuarioId($usuarioId)
    {
        return $this->model->with(['tipo', 'usuario'])
            ->where('usuario_id', $usuarioId)
            ->get();
    }

    public function getByTipoId($tipoId)
    {
        return $this->model->with(['tipo', 'usuario'])
            ->where('tipo_id', $tipoId)
            ->get();
    }

    public function searchByName($nombre)
    {
        return $this->model->with(['tipo', 'usuario'])
            ->where(function ($query) use ($nombre) {
                $query->where('nombre', 'like', '%' . $nombre . '%')
                      ->orWhere('apellido', 'like', '%' . $nombre . '%');
            })
            ->get();
    }

    public function getByCedula($cedula)
    {
        return $this->model->with(['tipo', 'usuario'])
            ->where('cedula', $cedula)
            ->first();
    }
}
