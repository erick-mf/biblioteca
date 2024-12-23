<?php

namespace App\Controllers;

use App\Lib\Pages;
use App\Services\EjemplarService;

class EjemplarController
{
    private EjemplarService $ejemplarService;
    private Pages $page;

    public function __construct()
    {
        $this->ejemplarService = new EjemplarService();
        $this->page = new Pages();
    }

    public function index()
    {
        $ejemplares = $this->ejemplarService->getAllEjemplares();
        $this->page->render('ejemplares/index', ['ejemplares' => $ejemplares]);
    }

    public function show(int $id)
    {
        $ejemplar = $this->ejemplarService->getEjemplarById($id);
        if (!$ejemplar) {
            header('Location: /ejemplares');
            exit;
        }
        $this->page->render('ejemplares/show', ['ejemplar' => $ejemplar]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_libro' => $_POST['id_libro'] ?? '',
                'codigo' => $_POST['codigo'] ?? '',
                'estado' => $_POST['estado'] ?? '',
            ];
            $ejemplar = $this->ejemplarService->createEjemplar($data);
            if ($ejemplar) {
                header('Location: /ejemplares/' . $ejemplar->id_ejemplar());
                exit;
            } else {
                // Manejar error
            }
        }
        $this->page->render('ejemplares/create');
    }

    public function update(int $id)
    {
        $ejemplar = $this->ejemplarService->getEjemplarById($id);
        if (!$ejemplar) {
            header('Location: /ejemplares');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_libro' => $_POST['id_libro'] ?? '',
                'codigo' => $_POST['codigo'] ?? '',
                'estado' => $_POST['estado'] ?? '',
            ];
            if ($this->ejemplarService->updateEjemplar($id, $data)) {
                header('Location: /ejemplares/' . $id);
                exit;
            } else {
                // Manejar error
            }
        }
        $this->page->render('ejemplares/edit', ['ejemplar' => $ejemplar]);
    }

    public function delete(int $id)
    {
        if ($this->ejemplarService->deleteEjemplar($id)) {
            header('Location: /ejemplares');
            exit;
        } else {
            // Manejar error
        }
    }
}
