<?php

namespace App\Lib;

use DateTime;

class SanitValidForm
{

    public static function validString($string): bool
    {
        $string = self::sanitInput($string);
        if (empty($string) || ! preg_match('/^[a-zA-Z]+$/', $string)) {
            return false;
        }

        return true;
    }

    public static function validEmail($email): mixed
    {
        if (empty($email) || ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    public static function validDNI($dni): bool
    {
        $dni = strtoupper(self::sanitInput($dni));
        if (empty($dni) || ! preg_match('/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/', $dni)) {
            return false;
        }

        return true;
    }

    public static function validPassword($pass): bool|string
    {
        if (strlen($pass) < 8) {
            return false;
        }

        return true;
    }

    public static function validTel($tel): bool
    {
        if (empty($tel) || ! preg_match('/^[0-9]{9}$/', $tel)) {
            return false;
        }

        return true;
    }

    public static function sanitInput($input): string
    {
        $input = trim($input);
        $input = stripcslashes($input);
        $input = htmlspecialchars($input);

        return $input;
    }

    public static function validIsbn($isbn): bool
    {
        if (empty($isbn)) {
            return false;
        }

        $length = strlen($isbn);
        if ($length != 10 && $length != 13) {
            return false;
        }

        return true;
    }

    public static function validFechaPublicacion($fecha): bool
    {
        $fechaObj = DateTime::createFromFormat('Y-m-d', $fecha);
        if (!$fechaObj) {
            return false;
        }

        $now = new DateTime();
        if ($fechaObj > $now) {
            return false;
        }

        return true;
    }

    public static function validCodigo($codigo): bool
    {
        if (empty($codigo)) {
            return false;
        }

        if (strlen($codigo) > 50) {
            return false;
        }

        return true;
    }

    public static function validEstado($estado): bool
    {
        $estadosValidos = ['disponible', 'prestado', 'en reparación', 'perdido'];
        $estadoLower = strtolower($estado);

        if (!in_array($estadoLower, $estadosValidos)) {
            return false;
        }

        return true;
    }
}
