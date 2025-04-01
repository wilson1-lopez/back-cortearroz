<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Services\UsuarioService;
use Illuminate\Http\JsonResponse;

class UsuarioController extends Controller
{
  


    public function __construct( protected UsuarioService $usuarioService){}

    public function index(): JsonResponse
    {
        return response()->json($this->usuarioService->getAllUsers());
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->usuarioService->getUserById($id));
    }

    public function store(UsuarioRequest $request): JsonResponse
    {
        return response()->json($this->usuarioService->createUser($request->validated()), 201);
    }

    public function update(UsuarioRequest $request, $id): JsonResponse
    {
        return response()->json($this->usuarioService->updateUser($id, $request->validated()));
    }

    public function destroy($id): JsonResponse
    {
        return response()->json($this->usuarioService->deleteUser($id), 204);
    }
}