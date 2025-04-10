<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepuestoProveedoresRequest;
use App\Models\RepuestoProveedores;
use App\Services\RepuestoProveedoresService;

class RepuestoProveedoresController extends Controller{

    public function __construct(protected RepuestoProveedoresService $respuestoProveedoresService)
    {
        
    }

    public function store(RepuestoProveedoresRequest $request){

      return response()->json($this->respuestoProveedoresService->registrarRepuestoProveedores($request->validated(), 201)); 

    }
}