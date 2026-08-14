<?php

declare(strict_types=1);

namespace App\Services\Impl;

use App\Exceptions\EntityNotFoundException;
use App\Models\Supermercato;
use App\Repositories\SupermercatoRepository;
use App\Services\SupermercatoService;
use InvalidArgumentException;

final class SupermercatoServiceImpl implements SupermercatoService
{
    public function __construct(
        private readonly SupermercatoRepository $repository,
    ) {
    }

    /** @return list<Supermercato> */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function findById(int $id): Supermercato
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('ID non valido');
        }

        $supermercato = $this->repository->findById($id);

        if ($supermercato === null) {
            throw EntityNotFoundException::forId('Supermercato', $id);
        }

        return $supermercato;
    }
}
