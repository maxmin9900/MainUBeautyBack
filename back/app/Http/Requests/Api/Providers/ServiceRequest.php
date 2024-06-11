<?php

namespace App\Http\Requests\Api\Providers;

use App\Http\Requests\Api\ApiRequestValidation;
use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends ApiRequestValidation
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
            'price' => ['required', 'numeric'],
            'service_id' => ['required', 'exists:services,id'],
            'blockchain_id' => ['required']
        ];
    }
}
