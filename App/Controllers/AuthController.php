<?php

namespace App\Controllers;

use App\Lib\Pages;
use App\Services\UsuarioService;
use Exception;

class AuthController
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
                    $_SESSION['user_id'] = $result['user']->id_usuario();
                    $_SESSION['user_name'] = $result['user']->nombre();
                    $_SESSION['user_rol'] = $result['user']->rol();

                    header('Location: admin/dashboard');
                    exit;
                } else {
                    $errors['general'] = $result['error'];
                }
            }

            $this->page->render('login', ['errors' => $errors]);
        } else {
            $this->page->render('login', []);
        }
    }

    public function register(): void
    {

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

            try {
                $result = $this->usuarioService->register($userData);
                if ($result['success']) {

                    header('Location: /dashboard');
                    exit;
                } else {
                    $this->page->render('register', ['errors' => $result['errors']]);
                }
            } catch (Exception $e) {
                $this->page->render('register', ['error' => $e->getMessage()]);
            }
        } else {
            $this->page->render('register', []);
        }
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: /');
        exit;
    }

    // public function dashboard():void
    // {
    //     if (!isset($_SESSION['user_name'])) {
    //         header('Location: /login');
    //         exit;
    //     }
    //
    //     if(isset($_SESSION["user_rol"]) && $_SESSION["user_rol"] === "administrador") {
    //         $this->page->render("admin/dashboard", []);
    //     }elseif(isset($_SESSION["user_rol"]) && $_SESSION["user_rol"] === "bibliotecario") {
    //         $this->page->render("bibliotecario/dashboard", []);
    //     }else{
    //         $this->page->render("lector/dashboard", []);
    //     }
    // }
}
