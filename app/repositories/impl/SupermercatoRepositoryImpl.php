<?php

namespace App\Repositories\Impl;

use App\Models\Supermercato;
use App\Repositories\SupermercatoRepository;

final class SupermercatoRepositoryImpl implements SupermercatoRepository
{
    public function findAll(): array
    {
        return Supermercato::find()->toArray();
    }

    public function findById(int $id): ?Supermercato
    {
        $result = Supermercato::FindFirst([
            'conditions' => 'id = :id:',
            'bind' => ['id' => $id]
        ]);

        return $result === false ? null : $result;
    }

    public function save(Supermercato $supermercato): void
    {
        $supermercato->save();
    }

    public function delete(Supermercato $supermercato): void
    {
        $supermercato->delete();
    }
}