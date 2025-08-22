<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessClosureRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'date' => 'required|date',
            'type' => 'required|in:holiday,early_close',
            'close_time' => 'nullable|date_format:H:i',
            'reason' => 'nullable|string|max:200',
        ];
    }

}
