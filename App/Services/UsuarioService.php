<?php

namespace App\Services;

use App\Models\Usuario;
use App\Repositories\UsuarioRepository;

class UsuarioService
{
    private UsuarioRepository $usuarioRepository;

    public function __construct()
    {
        $this->usuarioRepository = new UsuarioRepository;
    }

    public function login(string $email, string $password): array
    {
        $usuario = $this->usuarioRepository->findByEmail($email);

        if (!$usuario || !password_verify($password, $usuario->clave())) {
            return ['success' => false, 'error' => 'Credenciales inválidas'];
        }

        return ['success' => true, 'user' => $usuario];
    }

    public function register(array $userData): array
    {
        $usuario = new Usuario();
        $usuario->setNombre($userData['nombre']);
        $usuario->setApellido1($userData['apellido1']);
        $usuario->setApellido2($userData['apellido2']);
        $usuario->setDireccion($userData['direccion']);
        $usuario->setEmail($userData['email']);
        $usuario->setTelefono($userData['telefono']);
        $usuario->setDni($userData['dni']);
        $usuario->setClave($userData['clave']);
        $usuario->setRol($userData['rol']);

        $errors = $usuario->valido();
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        // Asegurarse de que solo los administradores puedan crear bibliotecarios
        if ($userData['rol'] === 'bibliotecario' && !$this->isAdmin()) {
            return ['success' => false, 'errors' => ['rol' => 'No tienes permisos para crear bibliotecarios']];
        }

        // Verificar si el email ya está registrado
        if ($this->usuarioRepository->findByEmail($userData['email'])) {
            return ['success' => false, 'errors' => ['email' => 'El email ya está registrado']];
        }

        // Hashear la contraseña
        $usuario->setClave(password_hash($userData['clave'], PASSWORD_DEFAULT));

        $savedUser = $this->usuarioRepository->save($usuario);
        if ($savedUser) {
            return ['success' => true, 'user' => $savedUser];
        } else {
            return ['success' => false, 'errors' => ['db' => 'Error al guardar el usuario']];
        }
    }

    private function isAdmin(): bool
    {
        return isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'administrador';
    }
}
