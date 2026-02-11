<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFaqRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'question' => ['required', 'string', 'max:500'],
            'answer' => ['required', 'string', 'max:2000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
