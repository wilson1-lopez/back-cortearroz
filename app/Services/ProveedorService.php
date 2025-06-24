<?php

namespace App\Services;

use App\Models\Proveedor;
use App\Repositories\Proveedor\Interfaces\ProveedorRepositoyInterface;

class ProveedorService {

  public function __construct(protected ProveedorRepositoyInterface $proveedorRepository){}


   public function registrarProveedor(array $data)
   {
       return $this->proveedorRepository->create($data);
   }

   public function obtenerProveedoresPorUsuario($id)
   {
       return $this->proveedorRepository->obtenerProveedoresPorUsuario($id);
   }

   public function eliminarProveedor($id)
   {
       $proveedor = Proveedor::findOrFail($id);
   
       if ($proveedor->repuestos()->exists()) {
           throw new \Exception('No se puede eliminar el proveedor porque tiene repuestos asociados.');
       }
   
       $proveedor->delete();
   
       return ['mensaje' => 'Proveedor eliminado correctamente'];
   }

   
public function actualizarProveedor($id, array $data)
{
    return $this->proveedorRepository->actualizar($id, $data);
}


}