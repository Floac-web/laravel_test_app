<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BasketProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'quantity' => ['required', 'integer', 'max:100'],
        ];
    }
}
