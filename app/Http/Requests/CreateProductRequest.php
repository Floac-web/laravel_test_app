<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends ApiRequest
{
    public function rules(): array
    {
        $langs = [
            'langs' => ['required', 'array']
        ];

        $prices = [
            'prices' => ['required', 'array']
        ];

        foreach (localization()->getSupportedLocalesKeys() as $lang) {
            $defaultRule = $lang == config('app.locale')  ? 'required' : 'nullable';

            $langs["langs.$lang.title"] = [$defaultRule, 'string', 'max:190'];
            $langs["langs.$lang.description"] = [$defaultRule, 'string', 'max:15000'];
            $prices["prices.$lang.price"] = [$defaultRule, 'integer', 'max:15000'];
        }

        return array_merge($langs,$prices,[
            'categories' => ['string', 'exists:categories,id'],
        ]);
    }
}
