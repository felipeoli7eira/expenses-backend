<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseValidatorRequest;

class DeleteUserRequest extends BaseValidatorRequest
{
    protected $stopOnFirstFailure = true;

    #[\Override]
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'uuid' => ['required', 'string', 'size:36', 'exists:users,uuid']
        ];
    }

    public function messages()
    {
        return [
            'uuid.required' => 'A identificação do usuário é obrigatória',
            'uuid.size'     => 'A identificação do usuário está fora dos padrões estabelecidos',
            'uuid.exists'   => 'Usuário não encontrado no sistema',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'uuid' => $this->route('uuid')
        ]);
    }

    protected function passedValidation(): void
    {
        $this->merge([
            'uuid' => $this->uuid
        ]);
    }
}
