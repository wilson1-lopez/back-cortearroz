<?php

namespace App\Http\Controllers;

use App\Http\Requests\CorteRequest;
use App\Services\CorteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CorteController extends Controller
{
    public function __construct(
        protected CorteService $corteService
    ) {
        $this->corteService = $corteService;
    }

    /**
     * Obtener todos los cortes
     */
    public function index()
    {
        try {
            $cortes = $this->corteService->obtenerCortes();
            return response()->json([
                'success' => true,
                'data' => $cortes,
                'message' => 'Cortes obtenidos exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los cortes: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Registrar un nuevo corte
     */
    public function store(CorteRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $data = $request->validated();
                
                // Extraer datos de máquinas y trabajadores si están presentes
                $maquinas = $data['maquinas'] ?? [];
                $trabajadores = $data['trabajadores'] ?? [];
                unset($data['maquinas'], $data['trabajadores']);

                $corte = $this->corteService->registrarCorte($data);

                // Asignar máquinas si están presentes
                if (!empty($maquinas)) {
                    $this->corteService->asignarMaquinasACorte($corte->id, $maquinas);
                }

                // Asignar trabajadores si están presentes
                if (!empty($trabajadores)) {
                    $trabajadoresFormatted = [];
                    foreach ($trabajadores as $trabajador) {
                        $trabajadoresFormatted[$trabajador['trabajador_id']] = [
                            'precio_acordado' => $trabajador['precio_acordado']
                        ];
                    }
                    $this->corteService->asignarTrabajadoresACorte($corte->id, $trabajadoresFormatted);
                }

                // Recargar el corte con todas las relaciones
                $corteCompleto = $this->corteService->obtenerCortePorId($corte->id);

                return response()->json([
                    'success' => true,
                    'data' => $corteCompleto,
                    'message' => 'Corte registrado exitosamente'
                ], 201);
            });
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar el corte: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Obtener un corte específico
     */
    public function show($id)
    {
        try {
            $corte = $this->corteService->obtenerCortePorId($id);
            return response()->json([
                'success' => true,
                'data' => $corte,
                'message' => 'Corte obtenido exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener el corte: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Actualizar un corte
     */
    public function update(CorteRequest $request, $id)
    {
        try {
            return DB::transaction(function () use ($request, $id) {
                $data = $request->validated();
                
                // Extraer datos de máquinas y trabajadores si están presentes
                $maquinas = $data['maquinas'] ?? null;
                $trabajadores = $data['trabajadores'] ?? null;
                unset($data['maquinas'], $data['trabajadores']);

                $corte = $this->corteService->actualizarCorte($id, $data);

                // Actualizar máquinas si están presentes
                if ($maquinas !== null) {
                    $this->corteService->asignarMaquinasACorte($id, $maquinas);
                }

                // Actualizar trabajadores si están presentes
                if ($trabajadores !== null) {
                    $trabajadoresFormatted = [];
                    foreach ($trabajadores as $trabajador) {
                        $trabajadoresFormatted[$trabajador['trabajador_id']] = [
                            'precio_acordado' => $trabajador['precio_acordado']
                        ];
                    }
                    $this->corteService->asignarTrabajadoresACorte($id, $trabajadoresFormatted);
                }

                // Recargar el corte con todas las relaciones
                $corteCompleto = $this->corteService->obtenerCortePorId($id);

                return response()->json([
                    'success' => true,
                    'data' => $corteCompleto,
                    'message' => 'Corte actualizado exitosamente'
                ], 200);
            });
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el corte: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Eliminar un corte
     */
    public function destroy($id)
    {
        try {
            $this->corteService->eliminarCorte($id);
            return response()->json([
                'success' => true,
                'message' => 'Corte eliminado exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el corte: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Obtener cortes por cliente
     */
    public function getByCliente($clienteId)
    {
        try {
            $cortes = $this->corteService->obtenerCortesPorCliente($clienteId);
            return response()->json([
                'success' => true,
                'data' => $cortes,
                'message' => 'Cortes del cliente obtenidos exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los cortes del cliente: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener cortes por temporada
     */
    public function getByTemporada($temporadaId)
    {
        try {
            $cortes = $this->corteService->obtenerCortesPorTemporada($temporadaId);
            return response()->json([
                'success' => true,
                'data' => $cortes,
                'message' => 'Cortes de la temporada obtenidos exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los cortes de la temporada: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener cortes activos
     */
    public function getActivos()
    {
        try {
            $cortes = $this->corteService->obtenerCortesActivos();
            return response()->json([
                'success' => true,
                'data' => $cortes,
                'message' => 'Cortes activos obtenidos exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los cortes activos: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener cortes en un rango de fechas
     */
    public function getEnRango(Request $request)
    {
        try {
            $request->validate([
                'fecha_inicio' => 'required|date',
                'fecha_fin' => 'required|date|after_or_equal:fecha_inicio'
            ]);

            $cortes = $this->corteService->obtenerCortesEnRango(
                $request->fecha_inicio,
                $request->fecha_fin
            );

            return response()->json([
                'success' => true,
                'data' => $cortes,
                'message' => 'Cortes en el rango obtenidos exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los cortes en el rango: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Buscar cortes por descripción
     */
    public function searchByDescripcion(Request $request)
    {
        try {
            $request->validate([
                'descripcion' => 'required|string|min:1'
            ]);

            $cortes = $this->corteService->buscarCortesPorDescripcion($request->descripcion);

            return response()->json([
                'success' => true,
                'data' => $cortes,
                'message' => 'Búsqueda de cortes completada exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al buscar los cortes: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Obtener cortes por cliente y temporada
     */
    public function getByClienteYTemporada($clienteId, $temporadaId)
    {
        try {
            $cortes = $this->corteService->obtenerCortesPorClienteYTemporada($clienteId, $temporadaId);
            return response()->json([
                'success' => true,
                'data' => $cortes,
                'message' => 'Cortes del cliente y temporada obtenidos exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los cortes del cliente y temporada: ' . $e->getMessage()
            ], 500);
        }
    }
}
