<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Prodotto;


interface ProdottoService {
    /**
     * @return list<Prodotto>
     */

    public function findAll(): array;

    public function findById(int $id): Prodotto;


}
