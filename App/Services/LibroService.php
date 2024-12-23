<?php

namespace App\Services;

use App\Models\Libro;
use App\Repositories\LibroRepository;

class LibroService
{
    private LibroRepository $libroRepository;

    public function __construct()
    {
        $this->libroRepository = new LibroRepository();
    }

    public function getAllLibros(): array
    {
        return $this->libroRepository->findAll();
    }

    public function getLibroById(int $id): ?Libro
    {
        return $this->libroRepository->findById($id);
    }

    public function createLibro(array $data): ?Libro
    {
        $libro = new Libro();
        $libro->setTitulo($data['titulo']);
        $libro->setIsbn($data['isbn']);
        $libro->setEditorial($data['editorial']);
        $libro->setFecha_publicacion($data['fecha_publicacion']);

        // Validar el libro
        $errors = $libro->valido();
        if (!empty($errors)) {
            // Manejar los errores, puedes lanzar una excepción o retornar los errores
            return null; // O podrías retornar los errores para manejar en el controlador
        }

        // Guardar el libro si es válido
        return $this->libroRepository->save($libro);
    }

    public function updateLibro(int $id, array $data): bool
    {
        $libro = $this->libroRepository->findById($id);
        if (!$libro) {
            return false;
        }

        // Actualizar los datos del libro
        $libro->setTitulo($data['titulo']);
        $libro->setIsbn($data['isbn']);
        $libro->setEditorial($data['editorial']);
        $libro->setFecha_publicacion($data['fecha_publicacion']);

        // Validar el libro antes de actualizar
        $errors = $libro->valido();
        if (!empty($errors)) {
            // Manejar los errores, puedes lanzar una excepción o retornar los errores
            return false; // O podrías retornar los errores para manejar en el controlador
        }

        // Actualizar el libro si es válido
        return $this->libroRepository->update($libro);
    }

    public function deleteLibro(int $id): bool
    {
        return $this->libroRepository->delete($id);
    }
}
