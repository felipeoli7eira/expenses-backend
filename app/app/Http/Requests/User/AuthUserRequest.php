<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseValidatorRequest;

class AuthUserRequest extends BaseValidatorRequest
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
            'email'    => ['required', 'string', 'min:11', 'max:50', 'email', 'exists:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'O campo E-mail é obrigatório',
            'email.min'      => 'O campo E-mail está fora do padrões estabelecidos',
            'email.max'      => 'O campo E-mail está fora do padrões estabelecidos',
            'email.email'    => 'O campo E-mail está fora do padrões estabelecidos',
            'email.exists'   => 'E-mail e/ou senha incorreto',

            'password.required'  => 'O campo Senha é obrigatório' ,
            'password.min'       => 'A senha informada não está dentro dos padrões estabelecidos'
        ];
    }
}
