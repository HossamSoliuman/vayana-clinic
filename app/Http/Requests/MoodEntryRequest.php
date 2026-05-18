<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MoodEntryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'mood_score' => ['required', 'integer', 'between:1,5'],
            'mood_label' => ['nullable', 'string', 'max:50'],
            'notes' => ['nullable', 'string', 'max:2000'],
            'entry_date' => ['required', 'date'],
        ];
    }
}
