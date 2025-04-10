<?php

namespace App\Repositories\AccionMantenimiento;

use App\Models\AccionMantenimiento;
use App\Models\Maquina;
use App\Repositories\AccionMantenimiento\Interfaces\AccionMantenimientoRepositoryInterface;



class AccionMantenimientoRepository implements AccionMantenimientoRepositoryInterface
{
    public function all()
    {
        return AccionMantenimiento::all();
    }

    public function find($id)
    {
        return AccionMantenimiento::findOrFail($id);
    }   

    public function create(array $data)
    {
        return AccionMantenimiento::create($data);
    }

    public function update($id, array $data)
    {
        $accionmantenimiento = AccionMantenimiento::findOrFail($id);
        $accionmantenimiento->update($data);
        return $accionmantenimiento;
    }

    public function delete($id)
    {
        return AccionMantenimiento::destroy($id);
    }

    public function obtenerAccionesPorUsuarioYMaquina(int $usuarioId, int $maquinaId)
    {
        return Maquina::where('id', $maquinaId)
        ->where('usuario_id', $usuarioId)
        ->with(
            'mantenimientos.accionmantenimientos',
            'mantenimientos.repuestos_mantenimientos.repuestos_proveedores.repuesto',
            'mantenimientos.repuestos_mantenimientos.repuestos_proveedores.proveedor'
            )
        ->firstOrFail(); 
    
}
       
}

    
    

  

    


