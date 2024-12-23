<?php

namespace App\Models;

use App\Lib\SanitValidForm;

class Ejemplar
{
    public $id_ejemplar;
    public $id_libro;
    public $codigo;
    public $estado;

    public function id_ejemplar()
    {
        return $this->id_ejemplar;
    }

    public function id_libro()
    {
        return $this->id_libro;
    }

    public function codigo()
    {
        return $this->codigo;
    }

    public function estado()
    {
        return $this->estado;
    }

    public function setId_ejemplar($id_ejemplar): void
    {
        $this->id_ejemplar = $id_ejemplar;
    }

    public function setId_libro($id_libro): void
    {
        $this->id_libro = $id_libro;
    }

    public function setCodigo($codigo): void
    {
        $this->codigo = $codigo;
    }

    public function setEstado($estado): void
    {
        $this->estado = $estado;
    }

    public function valido(): array
    {
        $errors = [];

        if (!is_numeric($this->id_libro) || $this->id_libro <= 0) {
            $errors['id_libro'] = "El ID del libro no es válido.";
        }

        if (!SanitValidForm::validCodigo($this->codigo)) {
            $errors['codigo'] = "El código del ejemplar no es válido.";
        }

        if (!SanitValidForm::validEstado($this->estado)) {
            $errors['estado'] = "El estado del ejemplar no es válido.";
        }

        return $errors;
    }
}
