<?php

namespace App\Repositories\RepuestoProveedores;

use App\Models\RepuestoProveedores;
use App\Repositories\RepuestoProveedores\Interfaces\RepuestoProveedoresRepositoryInterface;

class RepuestoProveedoresRepository implements RepuestoProveedoresRepositoryInterface{

    public function all(){
        return RepuestoProveedores::all();
    }

    public function find($id){
        return RepuestoProveedores::findOrFail($id);
    }

    public function create(array $data){
        return RepuestoProveedores::create($data);
    }        

    public function update($id, array $data){        
        $repuestoproveedores = RepuestoProveedores::findOrFail($id);
        $repuestoproveedores->update($data);
        return $repuestoproveedores;
    }    

    public function delete($id){
        return RepuestoProveedores::destroy($id);
    }

    
}
