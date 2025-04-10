<?php

namespace App\Services;

use App\Repositories\Proveedor\Interfaces\ProveedorRepositoyInterface;

class ProveedorService {

  public function __construct(protected ProveedorRepositoyInterface $proveedorRepository){}


   public function registrarProveedor(array $data)
   {
       return $this->proveedorRepository->create($data);
   }


}