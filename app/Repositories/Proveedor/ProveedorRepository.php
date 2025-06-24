<?php

namespace App\Repositories\Proveedor;

use App\Models\Proveedor;
use App\Repositories\Proveedor\Interfaces\ProveedorRepositoyInterface;

class ProveedorRepository implements ProveedorRepositoyInterface{

    public function all(){
        return Proveedor::all();
    }

    public function find($id){
        return  Proveedor::findOrFail($id);
    }

    public function create(array $data){
        return Proveedor::create($data);
    }        

    public function update($id, array $data){        
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update($data);
        return $proveedor;
    }    

    public function delete($id){
        return Proveedor::destroy($id);
    }

    public function obtenerProveedoresPorUsuario($id){
        return Proveedor::where('usuario_id', $id)->get();
    }


public function actualizar($id, array $data)
{
    $proveedor = Proveedor::findOrFail($id);
    $proveedor->update($data);
    return $proveedor;
}
}
