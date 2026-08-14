<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Cliente;

interface ClienteRepository
{

    /** @return list<Cliente> */
    public function findAll(): array;

    public function findById(int $id): ?Cliente;

    public function save(Cliente $cliente): void;

    public function delete(Cliente $cliente): void;
}
