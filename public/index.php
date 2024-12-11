<?php

/**
 * Archivo de entrada principal para la aplicación.
 *
 * Este script carga las configuraciones necesarias,
 * inicializa las variables de entorno y llama al controlador frontal.
 */

require_once '../vendor/autoload.php';
require_once '../App/config/config.php';

use App\Controllers\FrontController;
use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;
use Dotenv\Exception\ValidationException;

try {
    // Crea una instancia de Dotenv y carga las variables de entorno desde el archivo .env
    $dotenv = Dotenv::createImmutable(__DIR__.'/..');
    $dotenv->load();

    // Verifica que las variables requeridas estén presentes y no estén vacías
    $dotenv->required(['SERVER', 'DB', 'USERNAME', 'PASSWORD'])->notEmpty();

    // Llama al método principal del controlador frontal
    FrontController::main();
} catch (InvalidPathException $e) {
    // Maneja el caso donde el archivo .env no se encuentra
    exit('Error: No se encontró el archivo .env. '.$e->getMessage());
} catch (ValidationException $e) {
    // Maneja el caso donde faltan variables requeridas en el archivo .env
    exit('Error: Faltan variables requeridas en el archivo .env. '.$e->getMessage());
} catch (Exception $e) {
    // Maneja cualquier otro error inesperado
    exit('Error inesperado: '.$e->getMessage());
}
