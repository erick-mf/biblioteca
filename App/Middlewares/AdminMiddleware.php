<?php

namespace App\Middlewares;

class AdminMiddleware
{
    public static function valido()
    {
        // Aquí implementa la lógica para validar si el usuario es admin
        // Por ejemplo, verificar la sesión o un token
        if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'administrador') {
            return true;
        }
        return false;
    }
}
