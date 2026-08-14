<?php
namespace app\Repositories;

use App\Models\Ordine;

interface OrdineRepository{

    public function findAll(): array;

    public function findById(int $id): ?Ordine;

    public function save(Ordine $ordine): void;

    public function delete(Ordine $ordine): void;
}