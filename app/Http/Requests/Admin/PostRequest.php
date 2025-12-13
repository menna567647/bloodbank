<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|file|max:2048|mimes:png,jpeg',
            'category_id' => 'required|exists:categories,id',
        ];
    }
    public function messages()
    {
        if (app()->getLocale() === 'ar') {
            return [
                'title.required' => 'حقل العنوان مطلوب',
                'content.required' => 'حقل المحتوي مطلوب',
                'image.file'     => 'يجب أن يكون الملف صورة صالحة',
                'image.max'      => 'يجب ألا يتجاوز حجم الصورة 2 ميغابايت',
                'image.mimes'    => 'يجب أن تكون الصورة من نوع: PNG أو JPEG',
                'category_id.required' => 'حقل الفئات مطلوب',
            ];
        }
        return [
            'category_id.required' => 'The category field is required',

        ];
    }
}
