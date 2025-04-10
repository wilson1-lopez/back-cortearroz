<?php

namespace App\Http\Controllers;

use App\Services\RepuestoMantenimientoService;
use App\Http\Requests\RepuestoMantenimientoRequest;
class RepuestoMantenimientoController extends Controller{

    public function __construct(protected RepuestoMantenimientoService $repuestoMantenimientoService)
    {
        
    }

    public function store(RepuestoMantenimientoRequest $request){

      return response()->json($this->repuestoMantenimientoService->registrarRepuestoMantenimiento($request->validated(), 201)); 

    }
}