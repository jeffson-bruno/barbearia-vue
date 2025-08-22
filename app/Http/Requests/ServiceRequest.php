<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
   public function authorize(): bool { return true; }
    public function rules(): array {
    return [
        'name' => 'required|string|max:120',
        'duration_min' => 'required|integer|min:5|max:240',
        'price' => 'required|numeric|min:0',
        'active' => 'boolean'
    ];
    }

}
