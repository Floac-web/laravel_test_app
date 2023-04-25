<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends ApiRequest
{
    public function rules(): array
    {
        $langs = [
            'langs' => ['required', 'array']
        ];

        foreach (localization()->getSupportedLocalesKeys() as $lang) {
            $langs["langs.$lang.name"] = [$lang == config('app.locale') ? 'required' : 'nullable', 'string', 'max:190'];
        }

        return array_merge($langs,[
            'status' => ['nullable', 'string', 'in:active,hide']
        ]);
    }
}
