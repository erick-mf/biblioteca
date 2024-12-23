<?php

namespace App\Models;

use App\Lib\SanitValidForm;

class Libro
{
    public $id_libro;
    public $titulo;
    public $isbn;
    public $editorial;
    public $fecha_publicacion;

    public function id_libro()
    {
        return $this->id_libro;
    }

    public function titulo()
    {
        return $this->titulo;
    }

    public function isbn()
    {
        return $this->isbn;
    }

    public function editorial()
    {
        return $this->editorial;
    }

    public function fecha_publicacion()
    {
        return $this->fecha_publicacion;
    }

    public function setId_libro($id_libro): void
    {
        $this->id_libro = $id_libro;
    }

    public function setTitulo($titulo): void
    {
        $this->titulo = $titulo;
    }

    public function setIsbn($isbn): void
    {
        $this->isbn = $isbn;
    }

    public function setEditorial($editorial): void
    {
        $this->editorial = $editorial;
    }

    public function setFecha_publicacion($fecha_publicacion): void
    {
        $this->fecha_publicacion = $fecha_publicacion;
    }

    public function valido(): array
    {
        $errors = [];

        if (!SanitValidForm::validString($this->titulo)) {
            $errors['titulo'] = "El título no es válido.";
        }

        if (!SanitValidForm::validIsbn($this->isbn)) {
            $errors['isbn'] = "El ISBN no es válido.";
        }

        if (!SanitValidForm::validString($this->editorial)) {
            $errors['editorial'] = "La editorial no es válida.";
        }

        if (!SanitValidForm::validFechaPublicacion($this->fecha_publicacion)) {
            $errors['fecha_publicacion'] = "La fecha de publicación no es válida.";
        }

        return $errors;
    }
}
