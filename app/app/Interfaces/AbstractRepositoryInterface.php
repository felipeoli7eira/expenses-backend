<?php

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use stdClass;

interface AbstractRepositoryInterface
{
    public function read(): LengthAwarePaginator;

    public function create(array $data): bool;

    public function update(array $data, int $userId): bool;

    public function delete(int $userId): bool;

    public function readOne(int $userId): stdClass | null;
}
