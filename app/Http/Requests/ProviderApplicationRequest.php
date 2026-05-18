<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProviderApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string', 'max:20'],
            'specialty' => ['nullable', 'string', 'max:255'],
            'license_number' => ['required', 'string', 'max:255'],
            'preferred_work_type' => ['required', 'in:online,in_person,hybrid'],
            'availability_description' => ['nullable', 'string', 'max:1000'],
            'license_document' => ['required', 'file', 'mimes:pdf', 'max:5120'],
            'cv_document' => ['required', 'file', 'mimes:pdf', 'max:5120'],
            'certificates' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
            'biography' => ['required', 'string', 'max:5000'],
        ];
    }
}
