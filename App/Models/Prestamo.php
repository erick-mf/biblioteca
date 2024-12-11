<?php

namespace App\Models;

class Prestamo
{
    public $id_prestamo;
    public $id_usuario;
    public $id_ejemplar;
    public $fecha_prestamo;
    public $fecha_devolucion_esperada;
    public $fecha_devolucion_real;
    public $estado_prestamo;
}
