<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;



class CreateDonationRequest extends FormRequest
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
            'patient_name' => 'required',
            'patient_age' => 'required|integer',
            'patient_phone' => 'required',
            'string',
            'blood_type_id' => 'required|exists:blood_types,id',
            'city_id' => 'required|exists:cities,id',
            'hospital_name' => 'required|string',
            'notes' => 'nullable|string',
            'number_of_bags' => 'required|integer',
            'client_id' => 'nullable',
        ];
    }
}
