<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Supermercato;

interface SupermercatoService
{
    /** @return list<Supermercato> */
    public function findAll(): array;

    public function findById(int $id): Supermercato;
}
