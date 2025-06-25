<?php

namespace App\Services;

use App\Repositories\Corte\Interfaces\CorteRepositoryInterface;

class CorteService
{
    public function __construct(
        protected CorteRepositoryInterface $corteRepository
    ) {
        $this->corteRepository = $corteRepository;
    }

    public function registrarCorte(array $data)
    {
        // Verificar solapamiento de fechas para el cliente y temporada
        if (isset($data['fecha_fin'])) {
            $solapamiento = $this->corteRepository->verificarSolapamiento(
                $data['fecha_inicio'],
                $data['fecha_fin'],
                $data['cliente_id'],
                $data['temporada_id']
            );

            if ($solapamiento) {
                throw new \Exception('Ya existe un corte que se solapa con las fechas especificadas para este cliente y temporada.');
            }
        }

        return $this->corteRepository->create($data);
    }

    public function obtenerCortes()
    {
        return $this->corteRepository->getAllWithRelations();
    }

    public function obtenerCortePorId($id)
    {
        $corte = $this->corteRepository->findWithRelations($id);
        
        if (!$corte) {
            throw new \Exception('Corte no encontrado.');
        }

        return $corte;
    }

    public function actualizarCorte($id, array $data)
    {
        // Si se están actualizando las fechas, verificar solapamiento
        if (isset($data['fecha_inicio']) && isset($data['fecha_fin'])) {
            $corte = $this->corteRepository->find($id);
            
            if (!$corte) {
                throw new \Exception('Corte no encontrado.');
            }

            $solapamiento = $this->corteRepository->verificarSolapamiento(
                $data['fecha_inicio'],
                $data['fecha_fin'],
                $data['cliente_id'] ?? $corte->cliente_id,
                $data['temporada_id'] ?? $corte->temporada_id,
                $id
            );

            if ($solapamiento) {
                throw new \Exception('Ya existe un corte que se solapa con las fechas especificadas para este cliente y temporada.');
            }
        }

        $corte = $this->corteRepository->update($id, $data);
        
        if (!$corte) {
            throw new \Exception('Error al actualizar el corte.');
        }

        return $corte;
    }

    public function eliminarCorte($id)
    {
        $corte = $this->corteRepository->find($id);
        
        if (!$corte) {
            throw new \Exception('Corte no encontrado.');
        }

        return $this->corteRepository->delete($id);
    }

    public function obtenerCortesPorCliente($clienteId)
    {
        return $this->corteRepository->getByClienteId($clienteId);
    }

    public function obtenerCortesPorTemporada($temporadaId)
    {
        return $this->corteRepository->getByTemporadaId($temporadaId);
    }

    public function obtenerCortesActivos()
    {
        return $this->corteRepository->getActivos();
    }

    public function obtenerCortesEnRango($fechaInicio, $fechaFin)
    {
        return $this->corteRepository->getEnRango($fechaInicio, $fechaFin);
    }

    public function buscarCortesPorDescripcion($descripcion)
    {
        return $this->corteRepository->searchByDescripcion($descripcion);
    }

    public function obtenerCortesPorClienteYTemporada($clienteId, $temporadaId)
    {
        return $this->corteRepository->getByClienteYTemporada($clienteId, $temporadaId);
    }

    public function asignarMaquinasACorte($corteId, array $maquinasIds)
    {
        $corte = $this->corteRepository->find($corteId);
        
        if (!$corte) {
            throw new \Exception('Corte no encontrado.');
        }

        return $this->corteRepository->asignarMaquinas($corteId, $maquinasIds);
    }

    public function asignarTrabajadoresACorte($corteId, array $trabajadores)
    {
        $corte = $this->corteRepository->find($corteId);
        
        if (!$corte) {
            throw new \Exception('Corte no encontrado.');
        }

        // Validar que todos los trabajadores tienen precio_acordado
        foreach ($trabajadores as $trabajadorId => $data) {
            if (!isset($data['precio_acordado']) || !is_numeric($data['precio_acordado'])) {
                throw new \Exception("El precio acordado es obligatorio para el trabajador ID: {$trabajadorId}");
            }
        }

        return $this->corteRepository->asignarTrabajadores($corteId, $trabajadores);
    }
}
