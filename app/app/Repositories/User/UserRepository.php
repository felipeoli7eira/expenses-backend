<?php

namespace App\Repositories\User;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use stdClass;
use Illuminate\Pagination\LengthAwarePaginator;
use Throwable;

class UserRepository implements UserRepositoryInterface
{
    public function read(): LengthAwarePaginator
    {
        return User::paginate();
    }

    public function create(array $data): bool
    {
        try
        {
            User::create($data);
        }
        catch (Throwable $throwable)
        {
            return false;
        }

        return true;
    }

    public function update(array $data, string $userUuid): bool
    {
        try
        {
            $user = User::findOrFail($userUuid);
            $user->update($data);
        }
        catch (Throwable $throwable)
        {
            return false;
        }

        return true;
    }

    public function delete(string $userUuid): bool
    {
        try
        {
            $user = User::findOrFail($userUuid);
            $user->delete();
        }
        catch (Throwable $throwable)
        {
            return false;
        }

        return true;
    }

    public function readOne(string $uuid): Model | null
    {
        try
        {
            $user = User::findOrFail($uuid);
        }
        catch (Throwable $throwable)
        {
            return null;
        }

        return $user;
    }
}
