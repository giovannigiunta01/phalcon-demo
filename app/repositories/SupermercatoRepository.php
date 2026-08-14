<?php
namespace app\Repositories;

use App\Models\Supermercato;

interface SupermercatoRepository{

    public function findAll(): array;

    public function findById(int $id): ?Supermercato;

    public function save(Supermercato $supermercato): void;

    public function delete(Supermercato $supermercato): void;
}