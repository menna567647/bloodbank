<?php

namespace App\Http\Requests\Api;

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
            'name' => 'required',
            'phone' => 'required|unique:clients,phone',
            'password' => 'required|min:6|confirmed',
            'email' => 'required|email|unique:clients,email',
            'dob' => 'required|date',
            'blood_type_id' => 'required|exists:blood_types,id',
            'last_donation_date' => 'required|date',
            'city_id' => 'required|exists:cities,id',
            'fcm_token' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        if (app()->getLocale() === 'ar') {
            return [
                'name.required'               => 'حقل الاسم مطلوب.',
                'phone.required'              => 'حقل رقم الهاتف مطلوب.',
                'phone.unique'                => 'رقم الهاتف مستخدم مسبقاً.',
                'password.required'           => 'حقل كلمة المرور مطلوب.',
                'password.min'                => 'كلمة المرور يجب أن تكون 6 أحرف على الأقل.',
                'password.confirmed'          => 'تأكيد كلمة المرور غير مطابق.',
                'email.required'              => 'حقل البريد الإلكتروني مطلوب.',
                'email.email'                 => 'يرجى إدخال بريد إلكتروني صالح.',
                'email.unique'                => 'البريد الإلكتروني مستخدم مسبقاً.',
                'dob.required'                => 'حقل تاريخ الميلاد مطلوب.',
                'dob.date'                    => 'يرجى إدخال تاريخ صالح.',
                'blood_type_id.required'      => 'حقل فصيلة الدم مطلوب.',
                'last_donation_date.required' => 'حقل تاريخ آخر تبرع مطلوب.',
                'last_donation_date.date'     => 'يرجى إدخال تاريخ صالح.',
                'city_id.required'            => 'حقل المدينة مطلوب.',
            ];
        }
        return [
            'dob.required' => 'Please provide your date of birth.',
            'dob.date'               => 'Please enter a valid date.',
            'blood_type_id.required' => 'Blood type is required.',
            'city_id.required'       => 'City is required.',
        ];
    }
}
