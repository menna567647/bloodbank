<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GovernrateRequest extends FormRequest
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
            'name' => 'required|unique:governrates,name',

        ];
    }
    public function messages()
    {
        if (app()->getLocale() === 'ar') {
            return [
                'name.required' => 'حقل الاسم مطلوب',
                'name.unique' => 'هذا الاسم مستخدم بالفعل',
            ];
        }
        return [];
    }
}
