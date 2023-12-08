<?php

namespace App\Http\Requests;

use App\Exceptions\ApiException;
use Dotenv\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
{
    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator): void
    {
        throw new ApiException(422, "Ошибка валидации данных", $validator->errors());
    }

    public function messages()
    {
        return [
            'login.required' => 'Логин обязателен',
            'email.email' => 'Неправильный формат почты',
            'category.name' => 'Имя обязательно',
            'category.max' => 'Неправильное значение',
        ];
    }
}
