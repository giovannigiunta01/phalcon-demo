<?php

declare(strict_types=1);

namespace App\Services\Impl;

use App\Exceptions\EntityNotFoundException;
use App\Models\Cliente;
use App\Repositories\ClienteRepository;
use App\Services\ClienteService;
use InvalidArgumentException;

final class ClienteServiceImpl implements ClienteService
{
    public function __construct(
        private readonly ClienteRepository $repository,
    ) {
    }

    /** @return list<Cliente> */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function findById(int $id): Cliente
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('ID non valido');
        }

        $cliente = $this->repository->findById($id);

        if ($cliente === null) {
            throw EntityNotFoundException::forId('Cliente', $id);
        }

        return $cliente;
    }
}
