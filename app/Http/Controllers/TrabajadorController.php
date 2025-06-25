<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrabajadorRequest;
use App\Services\TrabajadorService;
use Illuminate\Http\Request;

class TrabajadorController extends Controller
{
    public function __construct(
        protected TrabajadorService $trabajadorService
    ) {
        $this->trabajadorService = $trabajadorService;
    }

    /**
     * Obtener todos los trabajadores
     */
    public function index()
    {
        try {
            $trabajadores = $this->trabajadorService->obtenerTrabajadores();
            return response()->json([
                'success' => true,
                'data' => $trabajadores,
                'message' => 'Trabajadores obtenidos exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los trabajadores: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Registrar un nuevo trabajador
     */
    public function store(TrabajadorRequest $request)
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
            
            $trabajador = $this->trabajadorService->registrarTrabajador($data);
            
            return response()->json([
                'success' => true,
                'data' => $trabajador,
                'message' => 'Trabajador registrado exitosamente'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar el trabajador: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener un trabajador específico
     */
    public function show($id)
    {
        try {
            $trabajador = $this->trabajadorService->obtenerTrabajadorPorId($id);
            
            if (!$trabajador) {
                return response()->json([
                    'success' => false,
                    'message' => 'Trabajador no encontrado'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $trabajador,
                'message' => 'Trabajador obtenido exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener el trabajador: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Actualizar un trabajador
     */
    public function update(TrabajadorRequest $request, $id)
    {
        try {
            $trabajador = $this->trabajadorService->actualizarTrabajador($id, $request->validated());
            
            if (!$trabajador) {
                return response()->json([
                    'success' => false,
                    'message' => 'Trabajador no encontrado'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $trabajador,
                'message' => 'Trabajador actualizado exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el trabajador: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Eliminar un trabajador
     */
    public function destroy($id)
    {
        try {
            $eliminado = $this->trabajadorService->eliminarTrabajador($id);
            
            if (!$eliminado) {
                return response()->json([
                    'success' => false,
                    'message' => 'Trabajador no encontrado'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Trabajador eliminado exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el trabajador: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener trabajadores del usuario autenticado
     */
    public function getByUsuario(Request $request)
    {
        try {
            $usuario = $request->user();
            
            if (!$usuario) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario no autenticado'
                ], 401);
            }
            
            $usuarioId = $usuario->id;
            $trabajadores = $this->trabajadorService->obtenerTrabajadoresPorUsuario($usuarioId);
            
            // Verificar si la colección está vacía
            if ($trabajadores->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'data' => [],
                    'message' => 'No se encontraron trabajadores para este usuario'
                ], 200);
            }
            
            return response()->json([
                'success' => true,
                'data' => $trabajadores,
                'message' => 'Trabajadores del usuario obtenidos exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los trabajadores del usuario: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener trabajadores por tipo
     */
    public function getByTipo($tipoId)
    {
        try {
            $trabajadores = $this->trabajadorService->obtenerTrabajadoresPorTipo($tipoId);
            
            return response()->json([
                'success' => true,
                'data' => $trabajadores,
                'message' => 'Trabajadores del tipo obtenidos exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los trabajadores del tipo: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Buscar trabajadores por nombre
     */
    public function searchByName(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|min:2'
            ]);

            $trabajadores = $this->trabajadorService->buscarTrabajadoresPorNombre($request->nombre);
            
            return response()->json([
                'success' => true,
                'data' => $trabajadores,
                'message' => 'Búsqueda realizada exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error en la búsqueda: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener trabajador por cédula
     */
    public function getByCedula($cedula)
    {
        try {
            $trabajador = $this->trabajadorService->obtenerTrabajadorPorCedula($cedula);
            
            if (!$trabajador) {
                return response()->json([
                    'success' => false,
                    'message' => 'Trabajador no encontrado con esa cédula'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $trabajador,
                'message' => 'Trabajador encontrado exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al buscar el trabajador: ' . $e->getMessage()
            ], 500);
        }
    }

}
