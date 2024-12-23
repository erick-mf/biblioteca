<?php

namespace App\Repositories;

use App\Lib\DataBase;
use App\Models\Ejemplar;
use PDO;

class EjemplarRepository
{
    private DataBase $db;

    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM ejemplares");
        $ejemplaresData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $ejemplares = [];

        foreach ($ejemplaresData as $ejemplarData) {
            $ejemplar = new Ejemplar();
            $ejemplar->setId_ejemplar($ejemplarData['id_ejemplar']);
            $ejemplar->setId_libro($ejemplarData['id_libro']);
            $ejemplar->setCodigo($ejemplarData['codigo']);
            $ejemplar->setEstado($ejemplarData['estado']);
            $ejemplares[] = $ejemplar;
        }

        return $ejemplares;
    }

    public function findById(int $id): ?Ejemplar
    {
        $stmt = $this->db->prepare("SELECT * FROM ejemplares WHERE id_ejemplar = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Ejemplar::class);
        return $stmt->fetch() ?: null;
    }

    public function save(Ejemplar $ejemplar): ?Ejemplar
    {
        $sql = "INSERT INTO ejemplares (id_libro, codigo, estado)
                VALUES (:id_libro, :codigo, :estado)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_libro', $ejemplar->id_libro(), PDO::PARAM_INT);
        $stmt->bindValue(':codigo', $ejemplar->codigo(), PDO::PARAM_STR);
        $stmt->bindValue(':estado', $ejemplar->estado(), PDO::PARAM_STR);

        if ($stmt->execute()) {
            $ejemplar->setId_ejemplar($this->db->lastInsertId());
            return $ejemplar;
        }
        return null;
    }

    public function update(Ejemplar $ejemplar): bool
    {
        $sql = "UPDATE ejemplares SET id_libro = :id_libro, codigo = :codigo, estado = :estado
                WHERE id_ejemplar = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $ejemplar->id_ejemplar(), PDO::PARAM_INT);
        $stmt->bindValue(':id_libro', $ejemplar->id_libro(), PDO::PARAM_INT);
        $stmt->bindValue(':codigo', $ejemplar->codigo(), PDO::PARAM_STR);
        $stmt->bindValue(':estado', $ejemplar->estado(), PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM ejemplares WHERE id_ejemplar = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
