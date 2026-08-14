<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Supermercato;

interface SupermercatoRepository
{

    /** @return list<Supermercato> */
    public function findAll(): array;

    public function findById(int $id): ?Supermercato;

    public function save(Supermercato $supermercato): void;

    public function delete(Supermercato $supermercato): void;
}
