<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationFormRequest extends FormRequest
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
            'type' => 'required|integer',
            'category' => 'required|string',
            'project_title' => 'required|string',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'files' => 'required|array',
            'files.*' => 'file|mimes:pdf',
        ];
    }
}
