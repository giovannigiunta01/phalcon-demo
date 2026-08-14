<?php

namespace App\Repositories\Impl;

use App\Models\Cliente;
use App\Repositories\ClienteRepository;

final class ClienteRepositoryImpl implements ClienteRepository
{
    public function findAll(): array
    {
        return Cliente::find()->toArray();
    }

    public function findById(int $id): ?Cliente
    {
        $result = Cliente::FindFirst([
            'conditions' => 'id = :id:',
            'bind' => ['id' => $id]
        ]);

        return $result === false ? null : $result;
    }

    public function save(Cliente $cliente): void
    {
        $cliente->save();
    }

    public function delete(Cliente $cliente): void
    {
        $cliente->delete();
    }
}