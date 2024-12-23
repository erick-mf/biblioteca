<?php

namespace App\Models;

use App\Lib\SanitValidForm;

class Usuario
{
    private $id_usuario;

    private $nombre;

    private $apellido1;

    private $apellido2;

    private $direccion;

    private $email;

    private $telefono;

    private $dni;

    private $clave;

    private $rol;

    private $dni_confirmado;

    private $fecha_registro;

    public function id_usuario()
    {
        return $this->id_usuario;
    }

    public function nombre()
    {
        return $this->nombre;
    }

    public function apellido1()
    {
        return $this->apellido1;
    }

    public function apellido2()
    {
        return $this->apellido2;
    }

    public function direccion()
    {
        return $this->direccion;
    }

    public function email()
    {
        return $this->email;
    }

    public function telefono()
    {
        return $this->telefono;
    }

    public function dni()
    {
        return $this->dni;
    }

    public function clave()
    {
        return $this->clave;
    }

    public function rol()
    {
        return $this->rol;
    }

    public function dni_confirmado()
    {
        return $this->dni_confirmado;
    }

    public function fecha_registro()
    {
        return $this->fecha_registro;
    }

    public function setId_usuario($id_usuario): void
    {
        $this->id_usuario = $id_usuario;
    }

    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    public function setApellido1($apellido1): void
    {
        $this->apellido1 = $apellido1;
    }

    public function setApellido2($apellido2): void
    {
        $this->apellido2 = $apellido2;
    }

    public function setDireccion($direccion): void
    {
        $this->direccion = $direccion;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function setTelefono($telefono): void
    {
        $this->telefono = $telefono;
    }

    public function setDni($dni): void
    {
        $this->dni = $dni;
    }

    public function setClave($clave): void
    {
        $this->clave = $clave;
    }

    public function setRol($rol): void
    {
        $this->rol = $rol;
    }

    public function setDni_confirmado($dni_confirmado): void
    {
        $this->dni_confirmado = $dni_confirmado;
    }

    public function setFecha_registro($fecha_registro): void
    {
        $this->fecha_registro = $fecha_registro;
    }

    public function valido(): array
    {
        $errors = [];

        if (!SanitValidForm::validString($this->nombre)) {
            $errors['nombre'] = "El nombre es inválido.";
        }

        if (!SanitValidForm::validString($this->apellido1)) {
            $errors['apellido1'] = "El primer apellido es inválido.";
        }
        if (!empty($this->apellido2) && !SanitValidForm::validString($this->apellido2)) {
            $errors['apellido2'] = "El segundo apellido es inválido.";
        }

        if (!SanitValidForm::validDNI($this->dni)) {
            $errors['dni'] = "El DNI es inválido.";
        }

        if (!SanitValidForm::validEmail($this->email)) {
            $errors['email'] = "El correo electrónico es inválido.";
        }

        if (!empty($this->telefono) && !SanitValidForm::validTel($this->telefono)) {
            $errors['telefono'] = "El teléfono debe tener 9 dígitos.";
        }

        if (!SanitValidForm::validPassword($this->clave)) {
            $errors['clave'] = "La contraseña debe tener al menos 8 caracteres.";
        }

        return $errors;
    }
}
