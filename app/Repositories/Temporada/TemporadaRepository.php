<?php

namespace App\Repositories\Temporada;

use App\Models\Temporada;
use App\Repositories\Temporada\Interfaces\TemporadaRepositoryInterface;

class TemporadaRepository implements TemporadaRepositoryInterface
{
    public function __construct(
        protected Temporada $model
    ) {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->with('usuario')->get();
    }

    public function find($id)
    {
        return $this->model->with('usuario')->find($id);
    }

    public function create(array $data)
    {
        $temporada = $this->model->create($data);
        return $temporada->load('usuario');
    }

    public function update($id, array $data)
    {
        $temporada = $this->model->find($id);
        if ($temporada) {
            $temporada->update($data);
            return $temporada->load('usuario');
        }
        return null;
    }

    public function delete($id)
    {
        $temporada = $this->model->find($id);
        if ($temporada) {
            return $temporada->delete();
        }
        return false;
    }

    public function getByUsuarioId($usuarioId)
    {
        return $this->model->byUsuario($usuarioId)->with('usuario')->get();
    }

    public function getEnRango($fechaInicio, $fechaFin)
    {
        return $this->model->enRango($fechaInicio, $fechaFin)->with('usuario')->get();
    }

    public function searchByName($nombre)
    {
        return $this->model->where('nombre', 'LIKE', "%{$nombre}%")
                          ->with('usuario')
                          ->get();
    }

    public function getByNombre($nombre)
    {
        return $this->model->where('nombre', $nombre)->with('usuario')->first();
    }

    public function verificarSolapamiento($fechaInicio, $fechaFin, $usuarioId, $temporadaId = null)
    {
        $query = $this->model->byUsuario($usuarioId)
                            ->enRango($fechaInicio, $fechaFin);

        if ($temporadaId) {
            $query->where('id', '!=', $temporadaId);
        }

        return $query->exists();
    }
}
