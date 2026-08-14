<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Cliente;

interface ClienteService
{
    /** @return list<Cliente> */
    public function findAll(): array;

    public function findById(int $id): Cliente;
}
