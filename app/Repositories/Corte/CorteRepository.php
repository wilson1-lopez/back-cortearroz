<?php

namespace App\Repositories\Corte;

use App\Models\Corte;
use App\Repositories\Corte\Interfaces\CorteRepositoryInterface;

class CorteRepository implements CorteRepositoryInterface
{
    public function __construct(
        protected Corte $model
    ) {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->with(['cliente', 'temporada', 'maquinas', 'trabajadores'])->get();
    }

    public function find($id)
    {
        return $this->model->with(['cliente', 'temporada', 'maquinas', 'trabajadores'])->find($id);
    }

    public function create(array $data)
    {
        $corte = $this->model->create($data);
        return $corte->load(['cliente', 'temporada']);
    }

    public function update($id, array $data)
    {
        $corte = $this->model->find($id);
        if ($corte) {
            $corte->update($data);
            return $corte->load(['cliente', 'temporada', 'maquinas', 'trabajadores']);
        }
        return null;
    }

    public function delete($id)
    {
        $corte = $this->model->find($id);
        if ($corte) {
            return $corte->delete();
        }
        return false;
    }

    public function getByClienteId($clienteId)
    {
        return $this->model->byCliente($clienteId)
                          ->with(['cliente', 'temporada', 'maquinas', 'trabajadores'])
                          ->get();
    }

    public function getByTemporadaId($temporadaId)
    {
        return $this->model->byTemporada($temporadaId)
                          ->with(['cliente', 'temporada', 'maquinas', 'trabajadores'])
                          ->get();
    }

    public function getActivos()
    {
        return $this->model->activos()
                          ->with(['cliente', 'temporada', 'maquinas', 'trabajadores'])
                          ->get();
    }

    public function getEnRango($fechaInicio, $fechaFin)
    {
        return $this->model->enRango($fechaInicio, $fechaFin)
                          ->with(['cliente', 'temporada', 'maquinas', 'trabajadores'])
                          ->get();
    }

    public function searchByDescripcion($descripcion)
    {
        return $this->model->where('descripcion', 'LIKE', "%{$descripcion}%")
                          ->with(['cliente', 'temporada', 'maquinas', 'trabajadores'])
                          ->get();
    }

    public function getAllWithRelations()
    {
        return $this->model->with(['cliente', 'temporada', 'maquinas', 'trabajadores'])->get();
    }

    public function findWithRelations($id)
    {
        return $this->model->with(['cliente', 'temporada', 'maquinas', 'trabajadores'])->find($id);
    }

    public function verificarSolapamiento($fechaInicio, $fechaFin, $clienteId, $temporadaId, $corteId = null)
    {
        $query = $this->model->byCliente($clienteId)
                            ->byTemporada($temporadaId)
                            ->enRango($fechaInicio, $fechaFin);

        if ($corteId) {
            $query->where('id', '!=', $corteId);
        }

        return $query->exists();
    }

    public function asignarMaquinas($corteId, array $maquinasIds)
    {
        $corte = $this->model->find($corteId);
        if ($corte) {
            $corte->maquinas()->sync($maquinasIds);
            return $corte->load('maquinas');
        }
        return null;
    }

    public function asignarTrabajadores($corteId, array $trabajadores)
    {
        $corte = $this->model->find($corteId);
        if ($corte) {
            // $trabajadores debe tener el formato: [trabajador_id => ['precio_acordado' => valor], ...]
            $corte->trabajadores()->sync($trabajadores);
            return $corte->load('trabajadores');
        }
        return null;
    }

    public function getByClienteYTemporada($clienteId, $temporadaId)
    {
        return $this->model->byCliente($clienteId)
                          ->byTemporada($temporadaId)
                          ->with(['cliente', 'temporada', 'maquinas', 'trabajadores'])
                          ->get();
    }
}
