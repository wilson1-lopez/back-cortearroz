<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProveedorRequest;
use App\Models\Proveedor;
use App\Services\ProveedorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ProveedorController extends Controller{

    public function __construct(protected ProveedorService $proveedorservice)
    {
        
    }

    public function store(ProveedorRequest $request): JsonResponse
    {
        $data = $request->validated();
    
        $usuario = $request->user(); // aquí está el usuario autenticado
        $data['usuario_id'] = $usuario->id;
    
        $proveedor = $this->proveedorservice->registrarProveedor($data);
    
        return response()->json($proveedor, 201);
    }
    public function obtenerProveedoresPorUsuario(Request $request)
    {
        try {
            $usuarioId = $request->user()->id;
            return response()->json($this->proveedorservice->obtenerProveedoresPorUsuario($usuarioId));
        } catch (\Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 404);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->proveedorservice->eliminarProveedor($id);
            return response()->json(['mensaje' => 'Eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No se pudo eliminar el proveedor',
                'mensaje' => $e->getMessage()
            ], 400);
        }
    }


public function update(ProveedorRequest $request, $id): JsonResponse
{
    try {
        $data = $request->validated();
        $proveedor = $this->proveedorservice->actualizarProveedor($id, $data);
        return response()->json($proveedor, 200);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'No se pudo actualizar el proveedor',
            'mensaje' => $e->getMessage()
        ], 400);
    }
}
}