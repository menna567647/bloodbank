<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required',
            'fcm_token' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        if (app()->getLocale() === 'ar') {
            return [
                'email.required'    => 'حقل البريد الإلكتروني مطلوب.',
                'email.email'       => 'يرجى إدخال بريد إلكتروني صالح.',
                'password.required' => 'حقل كلمة المرور مطلوب.',
            ];
        }
        return [];
    }
}