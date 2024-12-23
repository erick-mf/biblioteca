<?php

namespace App\Controllers;

class ErrorController
{
    public static function showError404(): string
    {
        return "<p>la pagina que buscas no existe";
    }
}
