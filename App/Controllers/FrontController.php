<?php

namespace App\Controllers;

class FrontController
{
    public static function main(): void
    {
        // Obtener el controlador y la acción desde la URL
        $controller = $_GET['controller'] ?? CONTROLLER_DEFAULT;
        $action = $_GET['action'] ?? ACTION_DEFAULT;

        // Construir el nombre completo del controlador
        $controllerClass = "App\\Controllers\\" . ucfirst($controller) . "Controller";

        // Verificar si el controlador existe
        if (class_exists($controllerClass)) {
            $controlador = new $controllerClass();

            // Verificar si la acción existe en el controlador
            if (method_exists($controlador, $action)) {
                $controlador->$action();
            } else {
                self::showError("La acción '$action' no existe en el controlador '$controllerClass'.");
            }
        } else {
            self::showError("El controlador '$controllerClass' no existe.");
        }
    }

    private static function showError(string $message): void
    {
        http_response_code(404);
        print "<h1>Error 404</h1><h2>$message</h2><a href='/'>Regresar al inicio</a>";
        exit();
    }
}
