<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;

class ProductRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'price' => 'required|numeric|decimal:2|min:0,01|max:9999999999',
            'quantity' => 'required|integer|min:0',
            'photo' => 'max:255',
            'description' => 'required|max:255',
            'category_id' => 'required|integer',
        ];
    }
}
