<?php

namespace App\Middlewares;

class LectorMiddleware
{
    public static function valido()
    {
        // Lógica para validar si el usuario está autenticado
        if (isset($_SESSION['user_id'])) {
            return true;
        }
        return false;
    }
}
