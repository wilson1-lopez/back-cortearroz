<?php

namespace App\Repositories\Repuesto\Interfaces;

use App\Repositories\RepositoryInterface;

interface RepuestoRepositoryInterface extends RepositoryInterface
{
    public function obtenerRepuestosPorUsuario($id);
    public function asociarProveedor($repuestoId, $proveedorId, $precio);
    public function obtenerRepuestoConProveedor(int $repuestoId);
    public function delete($id);
}
