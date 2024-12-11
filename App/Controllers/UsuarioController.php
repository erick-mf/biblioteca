<?php

namespace App\Controllers;

use App\Lib\Pages;
use App\Services\UsuarioService;
use Exception;

class UsuarioController
{
    private UsuarioService $usuarioService;

    private Pages $page;

    public function __construct()
    {
        $this->usuarioService = new UsuarioService;
        $this->page = new Pages;
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = $_POST['user']['email'] ?? '';
            $clave = $_POST['user']['clave'] ?? '';

            $errors = [];

            if (empty($correo)) {
                $errors['email'] = 'El correo es requerido';
            }
            if (empty($clave)) {
                $errors['clave'] = 'La contraseña es requerida';
            }

            if (empty($errors)) {
                $result = $this->usuarioService->login($correo, $clave);

                if ($result['success']) {
                    // Login exitoso
                    session_start();
                    $_SESSION['user_id'] = $result['user']->id_usuario();
                    $_SESSION['user_name'] = $result['user']->nombre();
                    $_SESSION['user_rol'] = $result['user']->rol();

                    // Redirigir según el rol del usuario
                    if ($_SESSION['user_rol'] === 'administrador') {
                        header('Location: /dashboard'); // Redirigir al dashboard del administrador
                    } elseif ($_SESSION['user_rol'] === 'bibliotecario') {
                        header('Location: /bibliotecario/dashboard'); // Redirigir al dashboard del bibliotecario
                    } else {
                        header('Location: /dashboard'); // Redirigir al dashboard del lector
                    }
                    exit;
                } else {
                    // Login fallido
                    $errors['general'] = $result['error'];
                }
            }

            // Si hay errores, volver a mostrar el formulario con los errores
            $this->page->render('login', ['errors' => $errors]);
        } else {
            // Mostrar formulario de login
            $this->page->render('login', []);
        }
    }

    public function register(): void
    {
        $userRole = $_SESSION['user_rol'] ?? 'guest';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userData = [
            'nombre' => $_POST['user']['nombre'] ?? '',
            'apellido1' => $_POST['user']['apellido1'] ?? '',
            'apellido2' => $_POST['user']['apellido2'] ?? '',
            'direccion' => $_POST['user']['direccion'] ?? '',
            'email' => $_POST['user']['email'] ?? '',
            'telefono' => $_POST['user']['telefono'] ?? '',
            'dni' => $_POST['user']['dni'] ?? '',
            'clave' => $_POST['user']['clave'] ?? '',
            'rol' => $_POST['user']['rol'] ?? 'lector',
            ];

            // Si el usuario no es administrador, forzar el rol a 'lector'
            if ($userRole !== 'administrador') {
                $userData['rol'] = 'lector';
            }

            try {
                $result = $this->usuarioService->register($userData);
                if ($result['success']) {
                    // Redirigir al login después de un registro exitoso
                    header('Location: /login');
                    exit;
                } else {
                    $this->page->render('register', ['errors' => $result['errors'], 'userRole' => $userRole]);
                }
            } catch (Exception $e) {
                $this->page->render('register', ['error' => $e->getMessage(), 'userRole' => $userRole]);
            }
        } else {
            $this->page->render('register', ['userRole' => $userRole]);
        }
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: /');
        exit;
    }

    public function dashboard():void
    {
        session_start();
        if (!isset($_SESSION['user_name'])) {
            header('Location: /login');
            exit;
        }
        $this->page->render("user/dashboard", []);
    }
}
