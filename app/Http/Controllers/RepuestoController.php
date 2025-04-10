<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepuestoRequest;
use App\Services\RepuestoService;

class RepuestoController extends Controller{

    public function __construct(protected RepuestoService $repuestoService)
    {
        
    }

    public function store(RepuestoRequest $request){

      return response()->json($this->repuestoService->registrarRepuesto($request->validated(), 201)); 

    }
}