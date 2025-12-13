<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ];
    }
    public function messages(): array
    {
        if (app()->getLocale() === 'ar') {
            return [
                'name_ar.required' => 'حقل الاسم بالعربية مطلوب',
                'name_en.required' => 'حقل الاسم بالإنجليزية مطلوب',
                'name_ar.max' => 'يجب ألا يزيد الاسم بالعربية عن 255 حرفًا',
                'name_en.max' => 'يجب ألا يزيد الاسم بالإنجليزية عن 255 حرفًا',
            ];
        }

        return [
            'name_ar.required' => 'Arabic name is required.',
            'name_en.required' => 'English name is required.',
            'name_ar.max' => 'Arabic name must not exceed 255 characters.',
            'name_en.max' => 'English name must not exceed 255 characters.',
        ];
    }
}
