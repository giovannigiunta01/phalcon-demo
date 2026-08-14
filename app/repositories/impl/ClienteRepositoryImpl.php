<?php

declare(strict_types=1);

namespace App\Repositories\Impl;

use App\Exceptions\PersistenceException;
use App\Models\Cliente;
use App\Repositories\ClienteRepository;
use Phalcon\Db\Column;

final class ClienteRepositoryImpl implements ClienteRepository
{
    public function findAll(): array
    {
        return iterator_to_array(Cliente::find(), false);
    }

    public function findById(int $id): ?Cliente
    {
        $result = Cliente::findFirst([
            'conditions' => 'id = :id:',
            'bind' => ['id' => $id],
            'bindTypes' => ['id' => Column::BIND_PARAM_INT],
        ]);

        return $result === false ? null : $result;
    }

    public function save(Cliente $cliente): void
    {
        if ($cliente->save() === false) {
            throw new PersistenceException(
                'Impossibile salvare il cliente: ' . implode('; ', $cliente->getMessages())
            );
        }
    }

    public function delete(Cliente $cliente): void
    {
        if ($cliente->delete() === false) {
            throw new PersistenceException(
                'Impossibile eliminare il cliente: ' . implode('; ', $cliente->getMessages())
            );
        }
    }
}
