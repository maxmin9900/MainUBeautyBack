<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiRequestValidation;

class RegisterRequest extends ApiRequestValidation
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'token' => ['required', 'unique:users,walletId'],
            'level' => ['required'],
            'name' => ['required'],
            'surname' => ['required'],
            'email' => ['required', 'unique:users'],
            'phone' => ['required', 'unique:users'],
        ];

    }

}
