<?php

namespace App\Services;
use App\Repositories\Maquina\Interfaces\MaquinaRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MaquinaService
{
    public function __construct(protected MaquinaRepositoryInterface $maquinaRepository){}
    
        public function ObtenerMaquinas(){
            return $this->maquinaRepository->all();
    }

    public function obtenerMaquinaById($id)
    {
       return $this->maquinaRepository->find($id);
    }

    public function registrarMaquina(array $data)
    {
        return $this->maquinaRepository->create($data);
    }

    public function actualizarMaquina($id, array $data)
    {
        return $this->maquinaRepository->update($id, $data);
    }

    public function eliminarMaquina($id)
    {
        return $this->maquinaRepository->delete($id);
    }

    public function obtenerMaquinaConUsuario($id)
    {
        return $this->maquinaRepository->obtenerMaquinaConUsuario($id);
    }
    




}
