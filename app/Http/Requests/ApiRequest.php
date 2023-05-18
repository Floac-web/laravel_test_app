<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class ApiRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        // if ($this->wantsJson() || $this->ajax()) {s
            throw new HttpResponseException(response()->error($validator->errors()->first(), 422));
        // }
        // else {
            // throw (new ValidationException($validator))
            //             ->errorBag($this->errorBag)
            //             ->redirectTo($this->getRedirectUrl());
        // }
    }
}
