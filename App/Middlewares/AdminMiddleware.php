<?php

namespace App\Middlewares;

class AdminMiddleware
{
    public static function validate()
    {
        // Aquí implementa la lógica para validar si el usuario es admin
        // Por ejemplo, verificar la sesión o un token
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
            return true;
        }
        return false;
    }
}
