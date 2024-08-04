<?php

namespace App\Services\User;

use App\Http\Utils\ResponseFormatHandler;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Throwable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserService
{
    public function __construct(protected readonly UserRepositoryInterface $repo) {}

    public function create(array $data): JsonResponse
    {
        if ($this->repo->create($data)) {
            return ResponseFormatHandler::sendResponse(
                message: 'Usuário criado com sucesso',
                httpCode: Response::HTTP_CREATED
            );
        }

        return ResponseFormatHandler::sendError('Erro ao cadastrar o usuário');
    }

    public function update(array $data, string $userUuid): JsonResponse
    {
        if (! $this->repo->update($data, $userUuid)) {
            return ResponseFormatHandler::sendError('Usuário não atualizado');
        }

        return ResponseFormatHandler::sendResponse('Dados atualizados com sucesso');
    }

    public function delete(string $userUuid): JsonResponse
    {
        if (! $this->repo->delete($userUuid)) {
            return ResponseFormatHandler::sendError('Erro ao deletar este usuário');
        }

        return ResponseFormatHandler::sendResponse('Usuário deletado do sistema');
    }

    public function read(): JsonResponse
    {
        try
        {
            $users = $this->repo->read();
        }
        catch (Throwable $throwable)
        {
            return ResponseFormatHandler::sendError(
                message: 'Oops! erro na operação',
                responseData: [
                    'thMessage' => $throwable->getMessage()
                ]
            );
        }

        return ResponseFormatHandler::sendResponse(
            message: 'Usuários listados com sucesso',
            responseData: $users
        );
    }

    public function readOne(string $uuid): JsonResponse
    {
        $user = $this->repo->readOne($uuid);

        if ($user instanceof Model) {
            return ResponseFormatHandler::sendResponse(
                message: 'Usuário encontrado com sucesso',
                responseData: $user
            );
        }

        return ResponseFormatHandler::sendResponse('Usuário não encontrado');
    }
}
