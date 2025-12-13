<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
            'name' => 'required|unique:cities,name',
            'governrate_id' => 'required|exists:governrates,id',
        ];
    }
    public function messages()
    {
        if (app()->getLocale() === 'ar') {
            return [
                'name.required' => 'حقل الاسم مطلوب',
                'name.unique' => 'هذا الاسم مستخدم بالفعل',
                'governrate_id.required' =>  'حقل المحافظة مطلوب',
            ];
        }

        return [
            'governrate_id.required' =>  'The governorate field is required.',

        ];
    }
}
