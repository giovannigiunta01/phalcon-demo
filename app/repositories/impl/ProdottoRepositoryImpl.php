<?php

namespace App\Repositories\Impl;

use App\Models\Prodotto;
use App\Repositories\ProdottoRepository;

final class ProdottoRepositoryImpl implements ProdottoRepository
{
    public function findAll(): array
    {
        return Prodotto::find()->toArray();
    }

    public function findById(int $id): ?Prodotto
    {
        $result = Prodotto::FindFirst([
            'conditions' => 'id = :id:',
            'bind' => ['id' => $id]
        ]);

        return $result === false ? null : $result;
    }

    public function save(Prodotto $prodotto): void
    {
        $prodotto->save();
    }

    public function delete(Prodotto $prodotto): void
    {
        $prodotto->delete();
    }
}