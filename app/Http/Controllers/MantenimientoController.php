<?php

namespace App\Http\Controllers;

use App\Http\Requests\MantenimientoRequest;
use App\Services\MantenimientoService;
use Illuminate\Http\JsonResponse;

class MantenimientoController extends Controller
{
    public function __construct(protected MantenimientoService $mantenimientoService){}

    public function store(MantenimientoRequest $request): JsonResponse
  {
      return response()->json($this->mantenimientoService->registrarMantenimiento($request->validated(), 201));
  } 
}