<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;


class JwtMiddleware
{
    public function handle(Request $request, Closure $next): Response
    { $authHeader = $request->header('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()->json(['error' => 'Token no proporcionado'], 401);
        }
    
        $token = substr($authHeader, 7);
    
        try {
            $payload = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
    
            $user = User::find($payload->sub);
            if (!$user) {
                return response()->json(['error' => 'Usuario no encontrado'], 401);
            }
    
            // Establecer el usuario autenticado en el request
            $request->setUserResolver(fn () => $user);
            $request->attributes->set('user_id', $user->id);
    
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token inválido', 'detalle' => $e->getMessage()], 401);
        }
    
        return $next($request);
    }

}