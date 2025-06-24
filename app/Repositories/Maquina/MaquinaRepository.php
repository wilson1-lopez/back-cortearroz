<?php

namespace App\Repositories\Maquina;

use App\Models\Maquina;
use App\Repositories\Maquina\Interfaces\MaquinaRepositoryInterface;

class MaquinaRepository implements MaquinaRepositoryInterface{

    public function all(){
        return Maquina::all();
    }

    public function find($id){
        return Maquina::findOrFail($id);
    }

    public function create(array $data){
        return Maquina::create($data);
    }        

    public function update($id, array $data){        
        $maquina = Maquina::findOrFail($id);
        $maquina->update($data);
        return $maquina;
    }    

    public function delete($id){
        return Maquina::destroy($id);
    }

    public function obtenerMaquinaConUsuario($id){
        return Maquina::where('usuario_id', $id)
                        ->get();                  
    }
}
