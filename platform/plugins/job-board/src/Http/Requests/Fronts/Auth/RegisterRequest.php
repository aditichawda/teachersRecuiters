<?php

namespace Botble\JobBoard\Http\Requests\Fronts\Auth;

use Botble\Base\Facades\BaseHelper;
use Botble\Support\Http\Requests\Request;

class RegisterRequest extends Request
{
    public function rules(): array
    {
        // Get temp account ID from session to exclude from unique check
        $sessionData = session('registration_email_verification', []);
        $tempAccountId = $sessionData['temp_account_id'] ?? null;
        
        $emailRule = ['required', 'max:60', 'min:6', 'email'];
        if ($tempAccountId) {
            $emailRule[] = 'unique:jb_accounts,email,' . $tempAccountId;
        } else {
            $emailRule[] = 'unique:jb_accounts,email';
        }
        
        $rules = [
            // Step 1: Basic Information
            'full_name' => ['required', 'max:250', 'min:2'],
            'email' => $emailRule,
            'phone' => ['required', BaseHelper::getPhoneValidationRule()],
            'phone_country_code' => ['nullable', 'string', 'max:10'],
            'is_whatsapp_available' => ['nullable', 'boolean'],
            'resume' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:10240'], // Made nullable for multi-step registration
            'password' => ['required', 'min:6', 'confirmed'],
            
            // Step 2: Institution Type
            'institution_type' => ['nullable', 'in:school,edtech-company,online-education-platform,college,coaching-institute,book-publishing-company,non-profit-organization'],
            'institution_name' => ['nullable', 'string', 'max:200'],
            
            // Step 3: Location
            'country_id' => ['nullable', 'numeric'],
            'state_id' => ['nullable', 'numeric'],
            'city_id' => ['nullable', 'numeric'],
            'location_type' => ['nullable', 'in:current,native'],
            
            'agree_terms_and_policy' => ['sometimes', 'accepted:1'],
            
            // Verification code for direct registration
            'verification_code' => ['nullable', 'regex:/^[0-9]{5,6}$/'],
        ];

        // Add account type validation when employer registration is enabled
        if (setting('job_board_enabled_register_as_employer', 1)) {
            $rules['account_type'] = ['nullable', 'in:job-seeker,employer'];
        }

        return $rules;
    }
}
