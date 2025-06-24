<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request; 

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService){}

    public function login(LoginRequest $request) {
        $credentials = $request->only('email', 'password');
        $token = $this->authService->login($credentials);

        if (!$token) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        return response()->json([
            'message' => 'Autenticación exitosa',
            'access_token' => $token,
            'token_type' => 'bearer',
           
        ]);
    }

     public function loginWithFirebase(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $result = $this->authService->loginWithFirebase($request->email);

        if (!$result) {
            return response()->json(['error' => 'Correo no registrado'], 404);
        }

        return response()->json($result);
    }

}