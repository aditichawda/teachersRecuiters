<?php

namespace Botble\JobBoard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdmissionEnquiryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'company_id' => ['required', 'integer', 'exists:jb_companies,id'],
            'student_name' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email'],
            'admission_for_standard' => ['nullable', 'string', 'max:100'],
            'address' => ['nullable', 'string', 'max:500'],
            'message' => ['nullable', 'string', 'max:2000'],
        ];
    }
}
