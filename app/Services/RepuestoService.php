<?php

namespace App\Services;

use App\Models\Repuesto;
use App\Repositories\Repuesto\Interfaces\RepuestoRepositoryInterface;
use Illuminate\Support\Facades\DB;

class RepuestoService {

  public function __construct(protected RepuestoRepositoryInterface $repuestoRepository){}


   public function registrarRepuesto(array $data)
   {
      return DB::transaction(function () use ($data) {
        $repuestoData = $data;
        // Solo guardar el repuesto, sin asociar proveedor ni precio
        $repuesto = $this->repuestoRepository->create($repuestoData);
        return $repuesto;
      });
   }

   public function obtenerRepuestosPorUsuario($id)
   {
       return $this->repuestoRepository->obtenerRepuestosPorUsuario($id);
   }

   public function eliminarRepuesto($id)
   {
       return $this->repuestoRepository->delete($id);
   }

   

}