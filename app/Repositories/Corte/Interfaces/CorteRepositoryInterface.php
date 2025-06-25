<?php

namespace App\Repositories\Corte\Interfaces;

use App\Repositories\RepositoryInterface;

interface CorteRepositoryInterface extends RepositoryInterface
{
    /**
     * Obtener cortes por cliente
     */
    public function getByClienteId($clienteId);

    /**
     * Obtener cortes por temporada
     */
    public function getByTemporadaId($temporadaId);

    /**
     * Obtener cortes activos
     */
    public function getActivos();

    /**
     * Obtener cortes en rango de fechas
     */
    public function getEnRango($fechaInicio, $fechaFin);

    /**
     * Buscar cortes por descripción
     */
    public function searchByDescripcion($descripcion);

    /**
     * Obtener cortes con relaciones
     */
    public function getAllWithRelations();

    /**
     * Obtener corte por ID con todas las relaciones
     */
    public function findWithRelations($id);

    /**
     * Verificar si existe solapamiento de fechas para un cliente y temporada
     */
    public function verificarSolapamiento($fechaInicio, $fechaFin, $clienteId, $temporadaId, $corteId = null);

    /**
     * Asignar máquinas a un corte
     */
    public function asignarMaquinas($corteId, array $maquinasIds);

    /**
     * Asignar trabajadores a un corte
     */
    public function asignarTrabajadores($corteId, array $trabajadores);

    /**
     * Obtener cortes de un cliente en una temporada específica
     */
    public function getByClienteYTemporada($clienteId, $temporadaId);
}
