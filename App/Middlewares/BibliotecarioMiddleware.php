<?php

namespace App\Middlewares;

class BibliotecarioMiddleware
{
    public static function valido()
    {
        // Lógica para validar si el usuario es bibliotecario
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'bibliotecario') {
            return true;
        }
        return false;
    }
}
