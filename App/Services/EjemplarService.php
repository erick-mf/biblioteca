<?php

namespace App\Services;

use App\Models\Ejemplar;
use App\Repositories\EjemplarRepository;

class EjemplarService
{
    private EjemplarRepository $ejemplarRepository;

    public function __construct()
    {
        $this->ejemplarRepository = new EjemplarRepository();
    }

    public function getAllEjemplares(): array
    {
        return $this->ejemplarRepository->findAll();
    }

    public function getEjemplarById(int $id): ?Ejemplar
    {
        return $this->ejemplarRepository->findById($id);
    }

    public function createEjemplar(array $data): ?Ejemplar
    {
        $ejemplar = new Ejemplar();
        $ejemplar->setId_libro($data['id_libro']);
        $ejemplar->setCodigo($data['codigo']);
        $ejemplar->setEstado($data['estado']);

        return $this->ejemplarRepository->save($ejemplar);
    }

    public function updateEjemplar(int $id, array $data): bool
    {
        $ejemplar = $this->ejemplarRepository->findById($id);
        if (!$ejemplar) {
            return false;
        }

        $ejemplar->setId_libro($data['id_libro']);
        $ejemplar->setCodigo($data['codigo']);
        $ejemplar->setEstado($data['estado']);

        return $this->ejemplarRepository->update($ejemplar);
    }

    public function deleteEjemplar(int $id): bool
    {
        return $this->ejemplarRepository->delete($id);
    }
}
