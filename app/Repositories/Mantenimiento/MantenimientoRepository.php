<?php

namespace App\Repositories\Mantenimiento;

use App\Models\Mantenimiento;
use App\Repositories\Mantenimiento\Interfaces\MantenimientoRepositoryInterface; 

class MantenimientoRepository implements MantenimientoRepositoryInterface
{
    public function all()
    {
        return Mantenimiento::all();
    }

    public function find($id)
    {
        return Mantenimiento::findOrFail($id);
    }   

    public function create(array $data)
    {
        return Mantenimiento::create($data);
    }

    public function update($id, array $data)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);
        $mantenimiento->update($data);
        return $mantenimiento;
    }

    public function delete($id)
    {
        return Mantenimiento::destroy($id);
    }
    
    public function obtenerMantenimientosPorMaquinaId($id)
    {
        return \App\Models\Maquina::with([
            'mantenimientos.repuestos_mantenimientos.repuestos_proveedores.repuesto',
            'mantenimientos.repuestos_mantenimientos.repuestos_proveedores.proveedor',
            'mantenimientos.accionmantenimientos'
        ])->find($id);
    }
}
