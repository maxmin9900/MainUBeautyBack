<?php

namespace App\Http\Requests\Api\Providers;

use App\Http\Requests\Api\ApiRequestValidation;
use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends ApiRequestValidation
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
            'service_id' => ['required'],
            'likes' => ['required'],
            'votes' => ['required'],
            'totalScores' => ['required']
        ];
    }
}
