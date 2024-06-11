<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiRequestValidation extends FormRequest
{

    public function failedValidation(Validator $validator)
    {
        $data = [];
        foreach ($validator?->errors()?->messages() as $key => $error) {
            if (count($error)) {
                $data[$key] = $error[0];
            }
        }
        throw new HttpResponseException(response()->json([
            'message' => 'Please Complete Form',
            'data' => $data
        ],400));
    }
}
