<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
    return [
        'name' => 'required|string|max:150',
        'phone' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:150',
        'notes' => 'nullable|string',
        'active' => 'boolean'
    ];
    }

}
