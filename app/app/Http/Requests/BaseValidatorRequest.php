<?php

namespace App\Http\Requests;

use App\Http\Utils\ResponseFormatHandler;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class BaseValidatorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [];
    }

    public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            ResponseFormatHandler::sendError(
                message: 'Erros encontrados nos dados enviados',
                responseData: ['error' => $validator->errors()->first()]
            )
        );
    }
}
