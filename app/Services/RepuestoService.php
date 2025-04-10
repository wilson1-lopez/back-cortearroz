<?php

namespace App\Services;

use App\Repositories\Repuesto\Interfaces\RepuestoRepositoryInterface;

class RepuestoService {

  public function __construct(protected RepuestoRepositoryInterface $repuestoRepository){}


   public function registrarRepuesto(array $data)
   {
       return $this->repuestoRepository->create($data);
   }


}