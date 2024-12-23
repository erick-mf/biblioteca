<?php

namespace App\Repositories;

use App\Lib\DataBase;
use App\Models\Libro;
use PDO;

class LibroRepository
{
    private DataBase $db;

    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM libros");
        $librosData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $libros = [];

        foreach ($librosData as $libroData) {
            $libro = new Libro();
            $libro->setId_libro($libroData['id_libro']);
            $libro->setTitulo($libroData['titulo']);
            $libro->setIsbn($libroData['isbn']);
            $libro->setEditorial($libroData['editorial']);
            $libro->setFecha_publicacion($libroData['fecha_publicacion']);
            $libros[] = $libro;
        }

        return $libros;
    }

    public function findById(int $id): ?Libro
    {
        $stmt = $this->db->prepare("SELECT * FROM libros WHERE id_libro = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Libro::class);
        return $stmt->fetch() ?: null;
    }

    public function save(Libro $libro): ?Libro
    {
        $sql = "INSERT INTO libros (titulo, isbn, editorial, fecha_publicacion)
                VALUES (:titulo, :isbn, :editorial, :fecha_publicacion)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':titulo', $libro->titulo(), PDO::PARAM_STR);
        $stmt->bindValue(':isbn', $libro->isbn(), PDO::PARAM_STR);
        $stmt->bindValue(':editorial', $libro->editorial(), PDO::PARAM_STR);
        $stmt->bindValue(':fecha_publicacion', $libro->fecha_publicacion(), PDO::PARAM_STR);

        if ($stmt->execute()) {
            $libro->setId_libro($this->db->lastInsertId());
            return $libro;
        }
        return null;
    }

    public function update(Libro $libro): bool
    {
        $sql = "UPDATE libros SET titulo = :titulo, isbn = :isbn, editorial = :editorial,
                fecha_publicacion = :fecha_publicacion WHERE id_libro = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $libro->id_libro(), PDO::PARAM_INT);
        $stmt->bindValue(':titulo', $libro->titulo(), PDO::PARAM_STR);
        $stmt->bindValue(':isbn', $libro->isbn(), PDO::PARAM_STR);
        $stmt->bindValue(':editorial', $libro->editorial(), PDO::PARAM_STR);
        $stmt->bindValue(':fecha_publicacion', $libro->fecha_publicacion(), PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM libros WHERE id_libro = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
