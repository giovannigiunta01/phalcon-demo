<?php

declare(strict_types=1);

namespace App\Repositories\Impl;

use App\Exceptions\PersistenceException;
use App\Models\Ordine;
use App\Repositories\OrdineRepository;
use Phalcon\Db\Column;

final class OrdineRepositoryImpl implements OrdineRepository
{
    public function findAll(): array
    {
        return iterator_to_array(Ordine::find(), false);
    }

    public function findById(int $id): ?Ordine
    {
        $result = Ordine::findFirst([
            'conditions' => 'id = :id:',
            'bind' => ['id' => $id],
            'bindTypes' => ['id' => Column::BIND_PARAM_INT],
        ]);

        return $result === false ? null : $result;
    }

    public function save(Ordine $ordine): void
    {
        if ($ordine->save() === false) {
            throw new PersistenceException(
                'Impossibile salvare l\'ordine: ' . implode('; ', $ordine->getMessages())
            );
        }
    }

    public function delete(Ordine $ordine): void
    {
        if ($ordine->delete() === false) {
            throw new PersistenceException(
                'Impossibile eliminare l\'ordine: ' . implode('; ', $ordine->getMessages())
            );
        }
    }
}
