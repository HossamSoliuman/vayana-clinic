<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JournalEntryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'prompt_id' => ['nullable', 'exists:journal_prompts,id'],
            'mood_score' => ['nullable', 'integer', 'between:1,5'],
            'entry_date' => ['nullable', 'date'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('entry_date')) {
            $this->merge(['entry_date' => now()->toDateString()]);
        }
    }
}
