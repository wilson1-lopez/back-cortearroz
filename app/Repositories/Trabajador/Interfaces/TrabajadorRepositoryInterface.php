<?php

namespace App\Repositories\Trabajador\Interfaces;

use App\Repositories\RepositoryInterface;

interface TrabajadorRepositoryInterface extends RepositoryInterface
{
    /**
     * Obtener trabajadores por usuario
     */
    public function getByUsuarioId($usuarioId);

    /**
     * Obtener trabajadores por tipo
     */
    public function getByTipoId($tipoId);

    /**
     * Buscar trabajadores por nombre o apellido
     */
    public function searchByName($nombre);

    /**
     * Obtener trabajador por cédula
     */
    public function getByCedula($cedula);
}
