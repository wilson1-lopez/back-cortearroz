<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaquinaRequest;
use Illuminate\Http\JsonResponse;
use App\Services\MaquinaService;


class MaquinaController extends Controller
{
  public function __construct(protected MaquinaService $maquinaService){}

  public function index(): JsonResponse
  {
      return response()->json($this->maquinaService->ObtenerMaquinas());
  }

  public function show($id): JsonResponse
    {
        return response()->json($this->maquinaService->obtenerMaquinaById($id));
    }


  public function store(MaquinaRequest $request): JsonResponse
  {
      return response()->json($this->maquinaService->registrarMaquina($request->validated(), 201));
  }  

  public function update(MaquinaRequest $request, $id): JsonResponse
  {
      return response()->json($this->maquinaService->actualizarMaquina($id, $request->validated()));
  }

  public function destroy($id): JsonResponse
  {
      return response()->json($this->maquinaService->eliminarMaquina($id), 204);
  }

}
