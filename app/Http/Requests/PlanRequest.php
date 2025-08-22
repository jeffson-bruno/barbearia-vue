<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'name' => 'required|string|max:120',
            'description' => 'nullable|string',
            'price_month' => 'required|numeric|min:0',
            'active' => 'boolean',
            'benefits' => 'array',          // opcional: benefícios enviados no payload
            'benefits.*' => 'string|max:200'
        ];
    }

}
