<?php

namespace App\Repositories\Impl;

use App\Models\Ordine;
use App\Repositories\OrdineRepository;

final class OrdineRepositoryImpl implements OrdineRepository
{
    public function findAll(): array
    {
        return Ordine::find()->toArray();
    }

    public function findById(int $id): ?Ordine
    {
        $result = Ordine::FindFirst([
            'conditions' => 'id = :id:',
            'bind' => ['id' => $id]
        ]);

        return $result === false ? null : $result;
    }

    public function save(Ordine $ordine): void
    {
        $ordine->save();
    }

    public function delete(Ordine $ordine): void
    {
        $ordine->delete();
    }
}