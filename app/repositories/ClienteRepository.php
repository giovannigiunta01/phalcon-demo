<?php
namespace app\Repositories;

use App\Models\Cliente;

interface ClienteRepository{

    public function findAll(): array;

    public function findById(int $id): ?Cliente;

    public function save(Cliente $cliente): void;

    public function delete(Cliente $cliente): void;
}