<?php

namespace App\Repositories;

use App\Lib\DataBase;
use App\Models\Usuario;
use PDO;

class UsuarioRepository
{
    private DataBase $db;

    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function findByEmail(string $email): ?Usuario
    {
        $stmt = $this->db->prepare('SELECT * FROM usuarios WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $userData = $stmt->fetch();

        if (! $userData) {
            return null;
        }

        return $this->createUsuarioFromArray($userData);
    }

    private function createUsuarioFromArray(array $userData): Usuario
    {
        $usuario = new Usuario;
        $usuario->setId_usuario($userData['id_usuario']);
        $usuario->setNombre($userData['nombre']);
        $usuario->setApellido1($userData['apellido1']);
        $usuario->setApellido2($userData['apellido2']);
        $usuario->setDireccion($userData['direccion']);
        $usuario->setEmail($userData['email']);
        $usuario->setTelefono($userData['telefono']);
        $usuario->setDni($userData['dni']);
        $usuario->setClave($userData['clave']);
        $usuario->setRol($userData['rol']);
        $usuario->setDni_confirmado($userData['dni_confirmado']);
        $usuario->setFecha_registro($userData['fecha_registro']);

        return $usuario;
    }

    public function save(Usuario $usuario): ?Usuario
    {
        $sql = "INSERT INTO usuarios (nombre, apellido1, apellido2, direccion, email, telefono, dni, clave, rol, dni_confirmado, fecha_registro)
            VALUES (:nombre, :apellido1, :apellido2, :direccion, :email, :telefono, :dni, :clave, :rol, :dni_confirmado, :fecha_registro)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nombre', $usuario->nombre(), PDO::PARAM_STR);
        $stmt->bindValue(':apellido1', $usuario->apellido1(), PDO::PARAM_STR);
        $stmt->bindValue(':apellido2', $usuario->apellido2(), PDO::PARAM_STR);
        $stmt->bindValue(':direccion', $usuario->direccion(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $usuario->email(), PDO::PARAM_STR);
        $stmt->bindValue(':telefono', $usuario->telefono(), PDO::PARAM_INT);
        $stmt->bindValue(':dni', $usuario->dni());
        $stmt->bindValue(':clave', $usuario->clave());
        $stmt->bindValue(':rol', $usuario->rol(), PDO::PARAM_STR);
        $stmt->bindValue(':dni_confirmado', false, PDO::PARAM_BOOL);
        $stmt->bindValue(':fecha_registro', date('Y-m-d H:i'));

        if ($stmt->execute()) {
            $usuario->setId_usuario($this->db->lastInsertId());
            $usuario->setDni_confirmado(false);
            $usuario->setFecha_registro(date('Y-m-d H:i'));
            return $usuario;
        }

        return null;
    }
}
