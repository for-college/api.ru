<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;

class UserRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'lastname' => 'required|max:255',
            'patronymic' => 'max:255',
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users|email',
            'sex' => 'required|boolean',
            'birth' => 'required|date',
            'login' => 'required|max:255|unique:users',
            'password' => 'required|max:255',
        ];
    }
}
