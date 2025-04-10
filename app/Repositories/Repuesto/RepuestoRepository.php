<?php

namespace App\Repositories\Repuesto;

use App\Models\Repuesto;
use App\Repositories\Repuesto\Interfaces\RepuestoRepositoryInterface;

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

    
}
