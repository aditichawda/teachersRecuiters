<?php

namespace Botble\JobBoard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdmissionEnquiryRequest extends FormRequest
{
    /**
     * Convert empty email/message to null so nullable rules pass.
     */
    protected function prepareForValidation(): void
    {
        $data = $this->all();
        if (isset($data['email']) && trim((string) $data['email']) === '') {
            $data['email'] = null;
        }
        if (isset($data['message']) && trim((string) $data['message']) === '') {
            $data['message'] = null;
        }
        $this->merge($data);
    }

    public function rules(): array
    {
        return [
            'company_id' => ['required', 'integer', 'exists:jb_companies,id'],
            'student_name' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'age' => ['required', 'string', 'max:50'],
            'admission_for_standard' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:500'],
            'message' => ['nullable', 'string', 'max:2000'],
        ];
    }
}
