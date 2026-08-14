<?php

declare(strict_types=1);

namespace App\Services\Impl;

use App\Exceptions\EntityNotFoundException;
use App\Models\Prodotto;
use App\Services\ProdottoService;
use App\Repositories\ProdottoRepository;
use InvalidArgumentException;

final class ProdottoServiceImpl implements ProdottoService
{
    public function __construct(
        private readonly ProdottoRepository $repository,
    ){}

    /**
     * @return list<Prodotto>
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function findById(int $id): Prodotto
    {
       if($id <= 0){
        throw new InvalidArgumentException('ID non valido');
       }

       $prodotto = $this->repository->findById($id);

       if($prodotto === null){
        throw EntityNotFoundException::forId('Prodotto', $id);
       }

       return $prodotto;
    }
}
