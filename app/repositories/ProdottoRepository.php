<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Prodotto;

interface ProdottoRepository
{
    
    /** @return list<Prodotto> */
    public function findAll(): array;

    public function findById(int $id): ?Prodotto;

    public function save(Prodotto $prodotto): void;

    public function delete(Prodotto $prodotto): void;
}
