<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoTrabajadorRequest;
use App\Services\TipoTrabajadorService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TipoTrabajadorController extends Controller
{
    public function __construct(
        protected TipoTrabajadorService $tipoTrabajadorService
    ) {
        $this->tipoTrabajadorService = $tipoTrabajadorService;
    }

    /**
     * Obtener todos los tipos de trabajadores
     */
    public function index(): JsonResponse
    {
        try {
            $tiposTrabajadores = $this->tipoTrabajadorService->obtenerTodos();
            
            return response()->json([
                'success' => true,
                'message' => 'Tipos de trabajadores obtenidos correctamente',
                'data' => $tiposTrabajadores
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los tipos de trabajadores',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Crear un nuevo tipo de trabajador
     */
    public function store(TipoTrabajadorRequest $request): JsonResponse
    {
        try {
            $tipoTrabajador = $this->tipoTrabajadorService->registrarTipoTrabajador($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'Tipo de trabajador creado exitosamente',
                'data' => $tipoTrabajador
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el tipo de trabajador',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener un tipo de trabajador específico
     */
    public function show($id): JsonResponse
    {
        try {
            $tipoTrabajador = $this->tipoTrabajadorService->obtenerPorId($id);
            
            if (!$tipoTrabajador) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tipo de trabajador no encontrado'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Tipo de trabajador obtenido correctamente',
                'data' => $tipoTrabajador
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener el tipo de trabajador',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Actualizar un tipo de trabajador
     */
    public function update(TipoTrabajadorRequest $request, $id): JsonResponse
    {
        try {
            $tipoTrabajador = $this->tipoTrabajadorService->actualizarTipoTrabajador($id, $request->validated());
            
            if (!$tipoTrabajador) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tipo de trabajador no encontrado'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Tipo de trabajador actualizado exitosamente',
                'data' => $tipoTrabajador
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el tipo de trabajador',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Eliminar un tipo de trabajador
     */
    public function destroy($id): JsonResponse
    {
        try {
            $eliminado = $this->tipoTrabajadorService->eliminarTipoTrabajador($id);
            
            if (!$eliminado) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tipo de trabajador no encontrado'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Tipo de trabajador eliminado exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el tipo de trabajador',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Buscar tipos de trabajadores por nombre
     */
    public function search(Request $request): JsonResponse
    {
        try {
            $nombre = $request->query('nombre');
            
            if (!$nombre) {
                return response()->json([
                    'success' => false,
                    'message' => 'El parámetro nombre es requerido'
                ], 400);
            }
            
            $tiposTrabajadores = $this->tipoTrabajadorService->buscarPorNombre($nombre);
            
            return response()->json([
                'success' => true,
                'message' => 'Búsqueda realizada correctamente',
                'data' => $tiposTrabajadores
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al buscar tipos de trabajadores',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
