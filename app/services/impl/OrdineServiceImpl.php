<?php

declare(strict_types=1);

namespace App\Services\Impl;

use App\Exceptions\EntityNotFoundException;
use App\Models\Ordine;
use App\Repositories\OrdineRepository;
use App\Services\OrdineService;
use InvalidArgumentException;

final class OrdineServiceImpl implements OrdineService
{
    public function __construct(
        private readonly OrdineRepository $repository,
    ) {
    }

    /** @return list<Ordine> */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function findById(int $id): Ordine
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('ID non valido');
        }

        $ordine = $this->repository->findById($id);

        if ($ordine === null) {
            throw EntityNotFoundException::forId('Ordine', $id);
        }

        return $ordine;
    }
}
