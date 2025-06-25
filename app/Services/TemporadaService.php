<?php

namespace App\Services;

use App\Repositories\Temporada\Interfaces\TemporadaRepositoryInterface;

class TemporadaService
{
    public function __construct(
        protected TemporadaRepositoryInterface $temporadaRepository
    ) {
        $this->temporadaRepository = $temporadaRepository;
    }

    public function registrarTemporada(array $data)
    {
        // Verificar solapamiento de fechas para el usuario
        $solapamiento = $this->temporadaRepository->verificarSolapamiento(
            $data['fecha_inicio'],
            $data['fecha_fin'],
            $data['usuario_id']
        );

        if ($solapamiento) {
            throw new \Exception('Ya existe una temporada que se solapa con las fechas especificadas.');
        }

        return $this->temporadaRepository->create($data);
    }

    public function obtenerTemporadas()
    {
        return $this->temporadaRepository->all();
    }

    public function obtenerTemporadaPorId($id)
    {
        $temporada = $this->temporadaRepository->find($id);
        
        if (!$temporada) {
            throw new \Exception('Temporada no encontrada.');
        }

        return $temporada;
    }

    public function actualizarTemporada($id, array $data)
    {
        // Si se están actualizando las fechas, verificar solapamiento
        if (isset($data['fecha_inicio']) && isset($data['fecha_fin'])) {
            $temporada = $this->temporadaRepository->find($id);
            
            if (!$temporada) {
                throw new \Exception('Temporada no encontrada.');
            }

            $solapamiento = $this->temporadaRepository->verificarSolapamiento(
                $data['fecha_inicio'],
                $data['fecha_fin'],
                $data['usuario_id'] ?? $temporada->usuario_id,
                $id
            );

            if ($solapamiento) {
                throw new \Exception('Ya existe una temporada que se solapa con las fechas especificadas.');
            }
        }

        $temporada = $this->temporadaRepository->update($id, $data);
        
        if (!$temporada) {
            throw new \Exception('Error al actualizar la temporada.');
        }

        return $temporada;
    }

    public function eliminarTemporada($id)
    {
        $temporada = $this->temporadaRepository->find($id);
        
        if (!$temporada) {
            throw new \Exception('Temporada no encontrada.');
        }

        return $this->temporadaRepository->delete($id);
    }

    public function obtenerTemporadasPorUsuario($usuarioId)
    {
        return $this->temporadaRepository->getByUsuarioId($usuarioId);
    }

    public function obtenerTemporadasEnRango($fechaInicio, $fechaFin)
    {
        return $this->temporadaRepository->getEnRango($fechaInicio, $fechaFin);
    }

    public function buscarTemporadasPorNombre($nombre)
    {
        return $this->temporadaRepository->searchByName($nombre);
    }
}
