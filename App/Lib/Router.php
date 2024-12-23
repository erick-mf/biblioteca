<?php

namespace App\Lib;

class Router
{
    private static $routes = [];
    private static $middlewares = [];

    public static function get(string $action, $controller):void
    {
        self::$routes['GET'][trim($action, '/')] = $controller;
    }

    public static function post(string $action, $controller):void
    {
        self::$routes['POST'][trim($action, '/')] = $controller;
    }

    public static function put(string $action, $controller):void
    {
        self::$routes['PUT'][trim($action, '/')] = $controller;
    }

    public static function delete(string $action, $controller):void
    {
        self::$routes['DELETE'][trim($action, '/')] = $controller;
    }

    public static function addMiddleware($prefijo, $middleware)
    {
        self::$middlewares [$prefijo] = $middleware;
    }

    public static function dispatch():void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        // Obtener la URI sin el prefijo del proyecto
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $action = trim($uri, '/');

        $param = null;
        if (preg_match('/[0-9]+$/', $action, $match)) {
            $param = $match[0];
            $action = preg_replace('/'.$match[0].'$/', ':id', $action);
        }

        // Verificar middlewares
        foreach (self::$middlewares as $prefix => $middleware) {
            if (strpos($action, $prefix) === 0) {
                if (!$middleware::valido()) {
                    header("HTTP/1.0 403 Forbidden");
                    echo "Acceso denegado";
                    return;
                }
                break;
            }
        }

        // Verificar si la ruta existe
        if (isset(self::$routes[$method][$action])) {
            $callback = self::$routes[$method][$action];
            if (is_array($callback)) {
                // Verifica si el controlador existe antes de instanciarlo
                if (class_exists($callback[0])) {
                    $controller = new $callback[0]();
                    echo $controller->{$callback[1]}($param);
                } else {
                    header("HTTP/1.0 500 Internal Server Error");
                    echo "Error: Controlador no encontrado.";
                }
            } else {
                echo call_user_func($callback, $param);
            }
        } else {
            header("HTTP/1.0 404 Not Found");
            echo "404 Not Found: $method $action";
        }
    }
}
