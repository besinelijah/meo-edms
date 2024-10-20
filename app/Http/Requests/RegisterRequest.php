<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            // "avatar" => ['file', 'nullable', 'max:300'],
            "fname" => ['required', 'max:255', 'string'],
            "mname" => ['nullable', 'max:255', 'string'],
            "lname" => ['required', 'max:255', 'string'],
            "contact_number" => ['required', 'digits:11'],
            "sex" => ['required', 'max:255', 'string'],
            "street" => ['nullable', 'max:255', 'string'],
            "brgy" => ['required', 'max:255', 'string'],
            "municipality" => ['required', 'max:255', 'string'],
            "province" => ['required', 'max:255', 'string'],
            "email" => ['required', 'email', 'max:255', 'unique:users'],
            "password" => ['required', 'confirmed'],
            "type" => ['required', 'integer'],
        ];
    }
}
