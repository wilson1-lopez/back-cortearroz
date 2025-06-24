<?php

namespace App\Http\Controllers;

use App\Http\Requests\MantenimientoRequest;
use App\Services\MantenimientoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mantenimiento;

class MantenimientoController extends Controller
{
    public function __construct(protected MantenimientoService $mantenimientoService){}

    public function store(MantenimientoRequest $request): JsonResponse
    {
        return response()->json(
            $this->mantenimientoService->registrarMantenimiento($request->validated()),
            201
        );
    } 

   public function storeCompleto(Request $request): JsonResponse
{
    $data = $request->all();
    try {
        DB::beginTransaction();
        $mantenimiento = $this->mantenimientoService->registrarMantenimientoCompleto($data);
        DB::commit();
        return response()->json($mantenimiento, 201);
    } catch (\Throwable $e) {
        DB::rollBack();
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

   

    public function detallePorMaquinaId($id)
    {
        $detalle = $this->mantenimientoService->obtenerDetallePorMaquinaId($id);

        if (!$detalle) {
            return response()->json(['message' => 'Máquina no encontrada'], 404);
        }

        return response()->json($detalle);
    }
}