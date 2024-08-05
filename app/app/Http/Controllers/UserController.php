<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\AuthUserRequest;
use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\ReadOneUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function read(Request $request): JsonResponse
    {
        return $this->userService->read();
    }

    public function readOne(ReadOneUserRequest $request): JsonResponse
    {
        return $this->userService->readOne($request->uuid);
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        return $this->userService->create($request->input());
    }

    public function update(UpdateUserRequest $request): JsonResponse
    {
        return $this->userService->update($request->except('uuid'), $request->input('uuid'));
    }

    public function delete(DeleteUserRequest $request): JsonResponse
    {
        return $this->userService->delete($request->input('uuid'));
    }

    public function login(AuthUserRequest $request): JsonResponse
    {
        return $this->userService->login($request->all());
    }

    public function logout(): JsonResponse
    {

    }
}
