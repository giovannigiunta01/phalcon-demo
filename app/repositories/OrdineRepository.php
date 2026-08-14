<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Ordine;

interface OrdineRepository
{

    /** @return list<Ordine> */
    public function findAll(): array;

    public function findById(int $id): ?Ordine;

    public function save(Ordine $ordine): void;

    public function delete(Ordine $ordine): void;
}
