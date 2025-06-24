<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaquinaRequest;
use Illuminate\Http\JsonResponse;
use App\Services\MaquinaService;
use Illuminate\Http\Request;

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
        $data = $request->validated();
    
        $usuario = $request->user(); // aquí está el usuario autenticado
        $data['usuario_id'] = $usuario->id;
    
        $maquina = $this->maquinaService->registrarMaquina($data);
    
        return response()->json($maquina, 201);
    }
    

  public function update(MaquinaRequest $request, $id): JsonResponse
  {
      return response()->json($this->maquinaService->actualizarMaquina($id, $request->validated()));
  }

  public function destroy($id): JsonResponse
  {
      return response()->json($this->maquinaService->eliminarMaquina($id), 200);
  }

  public function obtenerMaquinaConUsuario(Request $request)
{
    try {
        $usuarioId = $request->user()->id;
        return response()->json($this->maquinaService->obtenerMaquinaConUsuario($usuarioId));
    } catch (\Exception $e) {
        return response()->json(['mensaje' => $e->getMessage()], 404);
    }
}

}
