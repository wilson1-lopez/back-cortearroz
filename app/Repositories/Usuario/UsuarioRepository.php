<?php
namespace App\Repositories\Usuario;

use App\Models\User;
use App\Repositories\Usuario\Interfaces\UsuarioRepositoryInterface;

class UsuarioRepository implements UsuarioRepositoryInterface{
     public function all()
    {
        return User::all();
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update($id, array $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        return User::destroy($id);
    }

    public function obtenerUsuarioConMaquinas(int $id): ?User
    {
        return User::with('maquinas')->find($id);
    }
}