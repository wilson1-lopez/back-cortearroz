<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;


use App\Repositories\AuthRepository\Interfaces\AuthRepositoryInterface;

class AuthService
{
    public function __construct(protected AuthRepositoryInterface $authRepository){}

    public function login(array $credentials){
        return $this->authRepository->login($credentials);
    }

    public function loginWithFirebase($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return null;
        }

        
        // Generar el token usando JWTAuth directamente
    $token = JWTAuth::fromUser($user);
       

        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => $user
        ];
    }
 
}