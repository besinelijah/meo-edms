<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendDocumentRequest extends FormRequest
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
            'subject' => 'required|string',
            'message' => 'required|string',
            'recepientsEmailAddress' => ['required', 'string', function ($attribute, $value, $fail) {
                // Split the emails by comma or semicolon and trim whitespace
                $emails = array_map('trim', preg_split('/[,;]\s*/', $value));
                
                // Filter out invalid emails
                $invalidEmails = array_filter($emails, function ($email) {
                    return !filter_var($email, FILTER_VALIDATE_EMAIL);
                });
                
                // If there are any invalid emails, fail the validation
                if (count($invalidEmails) > 0) {
                    $fail('One or more email addresses are invalid.');
                }
            }],
        ];
    }

    public function messages(): array
    {
        return [
            'recepientsEmailAddress.required' => 'The email addresses field is required.',
            'recepientsEmailAddress.string' => 'The email addresses field must be a string.',
            'recepientsEmailAddress.custom_email_validation' => 'One or more email addresses are invalid.',
        ];
    }
}
