<?php

namespace App\Repositories\AuthRepository\Interfaces;
 
interface AuthRepositoryInterface{

    public function login(array $credentials);
}