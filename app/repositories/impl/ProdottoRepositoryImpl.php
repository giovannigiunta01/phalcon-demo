<?php

declare(strict_types=1);

namespace App\Repositories\Impl;

use App\Exceptions\PersistenceException;
use App\Models\Prodotto;
use App\Repositories\ProdottoRepository;
use Phalcon\Db\Column;

final class ProdottoRepositoryImpl implements ProdottoRepository
{
    public function findAll(): array
    {
        return iterator_to_array(Prodotto::find(), false);
    }

    public function findById(int $id): ?Prodotto
    {
        $result = Prodotto::findFirst([
            'conditions' => 'id = :id:',
            'bind' => ['id' => $id],
            'bindTypes' => ['id' => Column::BIND_PARAM_INT],
        ]);

        return $result === false ? null : $result;
    }

    public function save(Prodotto $prodotto): void
    {
        if ($prodotto->save() === false) {
            throw new PersistenceException(
                'Impossibile salvare il prodotto: ' . implode('; ', $prodotto->getMessages())
            );
        }
    }

    public function delete(Prodotto $prodotto): void
    {
        if ($prodotto->delete() === false) {
            throw new PersistenceException(
                'Impossibile eliminare il prodotto: ' . implode('; ', $prodotto->getMessages())
            );
        }
    }
}
