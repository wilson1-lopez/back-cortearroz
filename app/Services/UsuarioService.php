<?php
namespace App\Services;

use App\Repositories\Usuario\Interfaces\UsuarioRepositoryInterface;
class UsuarioService
{
    public function __construct(protected UsuarioRepositoryInterface $usuarioRepository){}
    public function getAllUsers()
    {
        return $this->usuarioRepository->all();
    }

    public function getUserById($id)
    {
        return $this->usuarioRepository->find($id);
    }

    public function createUser(array $data)
    {
        return $this->usuarioRepository->create($data);
    }

    public function updateUser($id, array $data)
    {
        return $this->usuarioRepository->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->usuarioRepository->delete($id);
    }

    public function obtenerUsuarioConMaquinas(int $id)
    {
        return $this->usuarioRepository->obtenerUsuarioConMaquinas($id);
    }
}