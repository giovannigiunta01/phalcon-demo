<?php
namespace app\Repositories;

use App\Models\Prodotto;

interface ProdottoRepository{
    
    public function findAll(): array;

    public function findById(int $id): ?Prodotto;

    public function save(Prodotto $prodotto): void;

    public function delete(Prodotto $prodotto): void;
}
