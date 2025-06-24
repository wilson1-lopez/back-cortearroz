<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepuestoRequest;
use App\Models\Repuesto;
use App\Services\RepuestoService;
use Illuminate\Http\Request;

class RepuestoController extends Controller{

    public function __construct(protected RepuestoService $repuestoService)
    {
        
    }

    public function store(RepuestoRequest $request){

      $data = $request->validated();
    
      $usuario = $request->user(); // aquí está el usuario autenticado
      $data['usuario_id'] = $usuario->id;
  
      $repuesto = $this->repuestoService->registrarRepuesto($data);
  
      return response()->json($repuesto, 201);

    }

    public function obtenerRepuestosPorUsuario(Request $request)
    {
      try {
          $usuarioId = $request->user()->id;
          return response()->json($this->repuestoService->obtenerRepuestosPorUsuario($usuarioId));
      } catch (\Exception $e) {
          return response()->json(['mensaje' => $e->getMessage()], 404);
      }
    }

    //eliminarRepuesto
    public function destroy($id)
    {
        try {
            $deleted = $this->repuestoService->eliminarRepuesto($id);
            if ($deleted) {
                return response()->json(['mensaje' => 'Repuesto eliminado correctamente.'], 200);
            } else {
                return response()->json(['mensaje' => 'Repuesto no encontrado.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['mensaje' => 'Error al eliminar el repuesto.'], 500);
        }
    }

   
}

