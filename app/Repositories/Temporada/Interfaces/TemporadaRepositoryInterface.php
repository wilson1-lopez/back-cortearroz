<?php

namespace App\Repositories\Temporada\Interfaces;

use App\Repositories\RepositoryInterface;

interface TemporadaRepositoryInterface extends RepositoryInterface
{
    /**
     * Obtener temporadas por usuario
     */
    public function getByUsuarioId($usuarioId);

    /**
     * Obtener temporadas en rango de fechas
     */
    public function getEnRango($fechaInicio, $fechaFin);

    /**
     * Buscar temporadas por nombre
     */
    public function searchByName($nombre);

    /**
     * Obtener temporada por nombre exacto
     */
    public function getByNombre($nombre);

    /**
     * Verificar si existe solapamiento de fechas
     */
    public function verificarSolapamiento($fechaInicio, $fechaFin, $usuarioId, $temporadaId = null);
}
