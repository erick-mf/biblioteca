<?php

/**
 * Archivo de entrada principal para la aplicación.
 *
 * Este script carga las configuraciones necesarias,
 * inicializa las variables de entorno y llama al controlador frontal.
 */

require_once '../vendor/autoload.php';
require_once '../App/config/config.php';

use App\Controllers\AdminController;
use App\Controllers\BibliotecarioController;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Lib\Router;
use App\Middlewares\LectorMiddleware;
use App\Middlewares\BibliotecarioMiddleware;
use App\Middlewares\AdminMiddleware;
use Dotenv\Dotenv;

try {
    $dotenv = Dotenv::createImmutable(__DIR__.'/..');
    $dotenv->safeLoad();

    session_start();

    Router::addMiddleware('admin', AdminMiddleware::class);
    Router::addMiddleware('bibliotecario', BibliotecarioMiddleware::class);
    Router::addMiddleware('usuario', LectorMiddleware::class);

    Router::get("", [HomeController::class, "index"]);
    Router::get("login", [AuthController::class, "login"]);
    Router::post("login", [AuthController::class, "login"]);
    Router::get("logout", [AuthController::class, "logout"]);
    Router::get("registrarse", [AuthController::class, "register"]);
    Router::post("registrarse", [AuthController::class, "register"]);
    Router::get("admin/dashboard", [AdminController::class, "dashboard"]);
    Router::get("bibliotecario/dashboard", [BibliotecarioController::class, "dashboard"]);

    Router::dispatch();
} catch (Exception $e) {
    exit('Error inesperado: '.$e->getMessage());
}
