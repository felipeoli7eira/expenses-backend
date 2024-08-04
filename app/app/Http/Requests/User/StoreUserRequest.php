<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseValidatorRequest;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class StoreUserRequest extends BaseValidatorRequest
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
            'name'     => ['required', 'string', 'min:3', 'max:50'],
            'email'    => ['required', 'string', 'min:11', 'max:50', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo Nome é obrigatório',
            'name.min'      => 'O campo Nome deve ter no mínimo 3 caracteres',
            'name.max'      => 'O campo Nome deve ter no máximo 50 caracteres',

            'email.required' => 'O campo E-mail é obrigatório',
            'email.min'      => 'O campo E-mail deve ter no mínimo 11 caracteres',
            'email.max'      => 'O campo E-mail deve ter no máximo 50 caracteres',
            'email.email'    => 'O campo E-mail deve ser preenchido com um e-mail dentro dos padrões válidos',
            'email.unique'   => 'O E-mail informado já está cadastrado no aplicativo. Considere recuperar a senha caso você seja o dono desse e-mail',

            'password.required'  => 'O campo Senha é obrigatório' ,
            'password.min'       => 'A senha informada não está dentro dos padrões estabelecidos',
            'password.confirmed' => 'As senhas informadas não são a mesma'
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([]);
    }

    protected function passedValidation(): void
    {
        $this->replace([
            'name'     => Str::lower($this->name),
            'email'    => Str::lower($this->email),
            'password' => Hash::make($this->password)
        ]);

        $this->merge([
            'uuid' => Uuid::uuid4()->toString()
        ]);
    }
}
