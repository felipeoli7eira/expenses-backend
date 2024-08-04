<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseValidatorRequest;

class ReadOneUserRequest extends BaseValidatorRequest
{
    protected $stopOnFirstFailure = true;

    #[\Override]
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['uuid' => $this->route('uuid')]);
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
            'uuid.required' => 'Identificador do usuário não informado',
            'uuid.string'   => 'Identificador fora dos padrões estabelecidos',
            'uuid.size'     => 'Identificador fora dos padrões estabelecidos',
            'uuid.exists'   => 'Usuário não encontrado',
        ];
    }
}
