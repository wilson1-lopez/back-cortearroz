<?php

namespace App\Repositories\RepuestoMantenimiento;

use App\Models\RepuestoMantenimiento;
use App\Repositories\RepuestoMantenimiento\Interfaces\RepuestoMantenimientoRepositoryInterface;


class RepuestoMantenimientoRepository implements RepuestoMantenimientoRepositoryInterface{

    public function all(){
        return RepuestoMantenimiento::all();
    }

    public function find($id){
        return  RepuestoMantenimiento::findOrFail($id);
    }

    public function create(array $data){
        return RepuestoMantenimiento::create($data);
    }        

    public function update($id, array $data){        
        $repuestomantenimiento = RepuestoMantenimiento::findOrFail($id);
        $repuestomantenimiento->update($data);
        return $repuestomantenimiento;
    }    

    public function delete($id){
        return RepuestoMantenimiento::destroy($id);
    }

    
}
