<?php

declare(strict_types=1);

namespace App\Repositories\Impl;

use App\Exceptions\PersistenceException;
use App\Models\Supermercato;
use App\Repositories\SupermercatoRepository;
use Phalcon\Db\Column;

final class SupermercatoRepositoryImpl implements SupermercatoRepository
{
    public function findAll(): array
    {
        return iterator_to_array(Supermercato::find(), false);
    }

    public function findById(int $id): ?Supermercato
    {
        $result = Supermercato::findFirst([
            'conditions' => 'id = :id:',
            'bind' => ['id' => $id],
            'bindTypes' => ['id' => Column::BIND_PARAM_INT],
        ]);

        return $result === false ? null : $result;
    }

    public function save(Supermercato $supermercato): void
    {
        if ($supermercato->save() === false) {
            throw new PersistenceException(
                'Impossibile salvare il supermercato: ' . implode('; ', $supermercato->getMessages())
            );
        }
    }

    public function delete(Supermercato $supermercato): void
    {
        if ($supermercato->delete() === false) {
            throw new PersistenceException(
                'Impossibile eliminare il supermercato: ' . implode('; ', $supermercato->getMessages())
            );
        }
    }
}
