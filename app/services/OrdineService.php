<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Ordine;

interface OrdineService
{
    /** @return list<Ordine> */
    public function findAll(): array;

    public function findById(int $id): Ordine;
}
