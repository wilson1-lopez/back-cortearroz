<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccionMantenimientoRequest;
use App\Services\AccionMantenimientoService;
use Illuminate\Http\JsonResponse;

class AccionMantenimientoController extends Controller
{
    public function __construct(protected AccionMantenimientoService $accionmantenimientoService){}

    public function store(AccionMantenimientoRequest $request): JsonResponse
    {
        return response()->json(
            $this->accionmantenimientoService->registrarAccionMantenimiento($request->validated()),
            201
        );
    } 

    public function accionesPorMaquinaYUsuario($usuarioId, $maquinaId)
    {
        try {
            $maquina = $this->accionmantenimientoService->obtenerAccionesPorUsuarioYMaquina($usuarioId, $maquinaId);

            return response()->json([
                'maquina' => [
                    'id' => $maquina->id,
                    'nombre' => $maquina->nombre,
                    'descripcion' => $maquina->descripcion,
                    'mantenimientos' => $maquina->mantenimientos,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 404);
        }
    }

}