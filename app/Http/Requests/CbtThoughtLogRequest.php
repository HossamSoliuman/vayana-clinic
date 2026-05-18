<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CbtThoughtLogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'situation' => ['required', 'string', 'max:2000'],
            'thought' => ['required', 'string', 'max:2000'],
            'emotion' => ['nullable', 'string', 'max:100'],
            'emotion_intensity' => ['nullable', 'integer', 'between:1,10'],
            'response' => ['nullable', 'string', 'max:2000'],
            'alternative_thought' => ['nullable', 'string', 'max:2000'],
            'log_date' => ['nullable', 'date'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('log_date')) {
            $this->merge(['log_date' => now()]);
        }
    }
}
