<?php

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use stdClass;

interface UserRepositoryInterface
{
    public function read(): LengthAwarePaginator;

    public function create(array $data): bool;

    public function update(array $data, string $userUuid): bool;

    public function delete(string $userId): bool;

    public function readOne(string $uuid): Model | null;
}
