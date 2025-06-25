<?php

namespace App\Http\Controllers;

use App\Http\Requests\TemporadaRequest;
use App\Services\TemporadaService;
use Illuminate\Http\Request;

class TemporadaController extends Controller
{
    public function __construct(
        protected TemporadaService $temporadaService
    ) {
        $this->temporadaService = $temporadaService;
    }

    /**
     * Obtener todas las temporadas
     */
    public function index()
    {
        try {
            $temporadas = $this->temporadaService->obtenerTemporadas();
            return response()->json([
                'success' => true,
                'data' => $temporadas,
                'message' => 'Temporadas obtenidas exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las temporadas: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Registrar una nueva temporada
     */
    public function store(TemporadaRequest $request)
    {
        try {
            $data = $request->validated();
            
            // Obtener el usuario autenticado y asignar su ID
            $usuario = $request->user();
            
            if (!$usuario) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario no autenticado'
                ], 401);
            }

            $data['usuario_id'] = $usuario->id;

            $temporada = $this->temporadaService->registrarTemporada($data);

            return response()->json([
                'success' => true,
                'data' => $temporada,
                'message' => 'Temporada registrada exitosamente'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar la temporada: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Obtener una temporada específica
     */
    public function show($id)
    {
        try {
            $temporada = $this->temporadaService->obtenerTemporadaPorId($id);
            return response()->json([
                'success' => true,
                'data' => $temporada,
                'message' => 'Temporada obtenida exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener la temporada: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Actualizar una temporada
     */
    public function update(TemporadaRequest $request, $id)
    {
        try {
            $data = $request->validated();
            
            // Obtener el usuario autenticado
            $usuario = $request->user();
            $data['usuario_id'] = $usuario->id;

            $temporada = $this->temporadaService->actualizarTemporada($id, $data);

            return response()->json([
                'success' => true,
                'data' => $temporada,
                'message' => 'Temporada actualizada exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la temporada: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Eliminar una temporada
     */
    public function destroy($id)
    {
        try {
            $this->temporadaService->eliminarTemporada($id);
            return response()->json([
                'success' => true,
                'message' => 'Temporada eliminada exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la temporada: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Obtener temporadas del usuario autenticado
     */
    public function getByUsuario(Request $request)
    {
        try {
            $usuario = $request->user();
            $temporadas = $this->temporadaService->obtenerTemporadasPorUsuario($usuario->id);
            
            return response()->json([
                'success' => true,
                'data' => $temporadas,
                'message' => 'Temporadas del usuario obtenidas exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las temporadas del usuario: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener temporadas en un rango de fechas
     */
    public function getEnRango(Request $request)
    {
        try {
            $request->validate([
                'fecha_inicio' => 'required|date',
                'fecha_fin' => 'required|date|after_or_equal:fecha_inicio'
            ]);

            $temporadas = $this->temporadaService->obtenerTemporadasEnRango(
                $request->fecha_inicio,
                $request->fecha_fin
            );

            return response()->json([
                'success' => true,
                'data' => $temporadas,
                'message' => 'Temporadas en el rango obtenidas exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las temporadas en el rango: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Buscar temporadas por nombre
     */
    public function searchByName(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|min:1'
            ]);

            $temporadas = $this->temporadaService->buscarTemporadasPorNombre($request->nombre);

            return response()->json([
                'success' => true,
                'data' => $temporadas,
                'message' => 'Búsqueda de temporadas completada exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al buscar las temporadas: ' . $e->getMessage()
            ], 400);
        }
    }
}
