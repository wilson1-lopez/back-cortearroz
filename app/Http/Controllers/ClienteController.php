<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Services\ClienteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct(protected ClienteService $clienteService)
    {
    }

    /**
     * Obtener todos los clientes
     */
    public function index(): JsonResponse
    {
        return response()->json($this->clienteService->obtenerTodosLosClientes());
    }

    /**
     * Obtener un cliente específico por ID
     */
    public function show($id): JsonResponse
    {
        try {
            $cliente = $this->clienteService->obtenerClientePorId($id);
            return response()->json($cliente);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
    }

    /**
     * Crear un nuevo cliente
     */
    public function store(ClienteRequest $request): JsonResponse
    {
        $data = $request->validated();
        
        // Obtener el usuario autenticado y asignar su ID
        $usuario = $request->user();
        $data['usuario_id'] = $usuario->id;
        
        $cliente = $this->clienteService->registrarCliente($data);
        
        return response()->json($cliente, 201);
    }

    /**
     * Actualizar un cliente existente
     */
    public function update(ClienteRequest $request, $id): JsonResponse
    {
        try {
            $data = $request->validated();
            $cliente = $this->clienteService->actualizarCliente($id, $data);
            return response()->json($cliente);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No se pudo actualizar el cliente',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Eliminar un cliente
     */
    public function destroy($id): JsonResponse
    {
        try {
            $this->clienteService->eliminarCliente($id);
            return response()->json(['message' => 'Cliente eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No se pudo eliminar el cliente',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Obtener clientes del usuario autenticado
     */
    public function obtenerClientesPorUsuario(Request $request): JsonResponse
    {
        try {
            $usuarioId = $request->user()->id;
            $clientes = $this->clienteService->obtenerClientesPorUsuario($usuarioId);
            return response()->json($clientes);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
