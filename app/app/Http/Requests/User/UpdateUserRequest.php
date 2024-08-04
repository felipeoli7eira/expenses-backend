<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseValidatorRequest;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * TODO:
 *
 * fazer o reset password ao inves de um update na senha.
 * pensar em uma maneira de permitir a atualizacao do email. por exemplo, enviar um email para a caixa do novo email informado
 * para que o usuario possa confirmar a mudança de email. Nessa request, quando ele clica no link enviado, a mudanã é executada
*/

class UpdateUserRequest extends BaseValidatorRequest
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
            'name' => ['string', 'min:3', 'max:50'],
            'uuid' => ['required', 'string', 'size:36', 'exists:users,uuid']
        ];
    }

    public function messages()
    {
        return [
            'name.min' => 'O campo Nome deve ter no mínimo 3 caracteres',
            'name.max' => 'O campo Nome deve ter no máximo 50 caracteres',

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
        $this->replace([
            'name' => Str::lower($this->name)
        ]);

        $this->merge([
            'uuid' => $this->uuid
        ]);
    }
}
