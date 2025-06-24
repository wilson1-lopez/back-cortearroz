<?php

namespace App\Repositories\Repuesto;

use App\Models\Repuesto;
use App\Repositories\Repuesto\Interfaces\RepuestoRepositoryInterface;
use Illuminate\Support\Facades\DB;

class RepuestoRepository implements RepuestoRepositoryInterface{

    public function all(){
        return Repuesto::all();
    }

    public function find($id){
        return Repuesto::findOrFail($id);
    }

    public function create(array $data){
        return Repuesto::create($data);
    }        

    public function update($id, array $data){        
        $repuesto = Repuesto::findOrFail($id);
        $repuesto->update($data);
        return $repuesto;
    }    

    public function delete($id){
        return Repuesto::destroy($id);
    }

    public function obtenerRepuestosPorUsuario($id){
        // Solo obtener los repuestos del usuario, sin proveedores
        return Repuesto::where('usuario_id', $id)->get();
    }

    public function asociarProveedor($repuestoId, $proveedorId, $precio)
    {
        DB::table('repuestos_proveedores')->insert([
            'repuesto_id' => $repuestoId,
            'proveedor_id' => $proveedorId,
            'precio' => $precio
        ]);
    }

    public function obtenerRepuestoConProveedor(int $repuestoId) {
        return Repuesto::with('proveedores')->findOrFail($repuestoId);
    }

    
}


