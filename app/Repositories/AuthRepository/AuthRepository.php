<?php

namespace App\Repositories\AuthRepository;

use App\Repositories\AuthRepository\Interfaces\AuthRepositoryInterface;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthRepository implements AuthRepositoryInterface{

    public function login(array $credentials) {
      if(!$token=JWTAuth::attempt($credentials)){
        return null;
      }
    return $token;

    }
}