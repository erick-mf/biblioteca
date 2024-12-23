<?php

namespace App\Controllers;

use App\Lib\Pages;
use App\Services\LibroService;

class LibroController
{
    private LibroService $libroService;
    private Pages $page;

    public function __construct()
    {
        $this->libroService = new LibroService();
        $this->page = new Pages();
    }

    public function index()
    {
        $libros = $this->libroService->getAllLibros();
        $this->page->render('libros/mostrar_todos', ['libros' => $libros]);
    }

    public function crear()
    {
        // Mostrar la vista para crear un nuevo libro
        $this->page->render('libros/crear', ['errors' => []]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario
            $data = [
                'titulo' => $_POST['titulo'] ?? '',
                'isbn' => $_POST['isbn'] ?? '',
                'editorial' => $_POST['editorial'] ?? '',
                'fecha_publicacion' => $_POST['fecha_publicacion'] ?? '',
            ];

            // Intentar crear el libro
            $libro = $this->libroService->createLibro($data);

            if ($libro) {
                // Redirigir al listado de libros si se crea correctamente
                header('Location: /libros');
                exit;
            } else {
                // Si hay errores, mostrar la vista de creación con errores
                $errors = $this->libroService->getErrors(); // Método que debes implementar para obtener errores
                $this->page->render('libros/create', ['errors' => $errors]);
            }
        } else {
            // Si no es un POST, redirigir al listado de libros
            header('Location: /libros');
            exit;
        }
    }

    public function edit(int $id)
    {
        $libro = $this->libroService->getLibroById($id);
        if (!$libro) {
            // Manejar el caso en que no se encuentra el libro
            header('Location: /libros');
            exit;
        }

        // Mostrar la vista de edición con los datos del libro
        $this->page->render('libros/edit', ['libro' => $libro, 'errors' => []]);
    }

    public function update(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario
            $data = [
                'titulo' => $_POST['titulo'] ?? '',
                'isbn' => $_POST['isbn'] ?? '',
                'editorial' => $_POST['editorial'] ?? '',
                'fecha_publicacion' => $_POST['fecha_publicacion'] ?? '',
            ];

            // Intentar actualizar el libro
            if ($this->libroService->updateLibro($id, $data)) {
                // Redirigir al listado de libros si se actualiza correctamente
                header('Location: /libros');
                exit;
            } else {
                // Si hay errores, volver a mostrar la vista de edición con errores
                $errors = $this->libroService->getErrors(); // Método que debes implementar para obtener errores
                $this->page->render('libros/edit', ['libro' => $data, 'errors' => $errors]);
            }
        } else {
            // Si no es un POST, redirigir al listado de libros
            header('Location: /libros');
            exit;
        }
    }

    public function delete(int $id)
    {
        if ($this->libroService->deleteLibro($id)) {
            // Redirigir al listado de libros después de eliminar
            header('Location: /libros');
            exit;
        } else {
            // Manejar error en la eliminación (opcional)
            header('Location: /libros');
            exit;
        }
    }
}
