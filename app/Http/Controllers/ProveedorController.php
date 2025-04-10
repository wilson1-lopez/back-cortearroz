<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProveedorRequest;
use App\Models\Proveedor;
use App\Services\ProveedorService;


class ProveedorController extends Controller{

    public function __construct(protected ProveedorService $proveedorservice)
    {
        
    }

    public function store(ProveedorRequest $request){

      return response()->json($this->proveedorservice->registrarProveedor($request->validated(), 201)); 

    }
}