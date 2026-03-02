<?php

namespace Botble\JobBoard\Http\Requests\Fronts\Auth;

use Botble\Base\Rules\EmailRule;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Validator;

class ForgotPasswordRequest extends Request
{
    public function rules(): array
    {
        return [
            'email' => ['required_without:phone', 'nullable', new EmailRule()],
            'phone' => ['required_without:email', 'nullable', 'string', 'min:10'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required_without' => trans('plugins/job-board::messages.email_or_phone_required', ['default' => 'Please provide either email or phone number.']),
            'phone.required_without' => trans('plugins/job-board::messages.email_or_phone_required', ['default' => 'Please provide either email or phone number.']),
            'phone.min' => trans('plugins/job-board::messages.phone_min_length', ['default' => 'Phone number must be at least 10 digits.']),
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $email = $this->input('email');
            $phone = $this->input('phone');
            
            // Check if both fields are filled
            if (!empty($email) && !empty($phone)) {
                $validator->errors()->add(
                    'email',
                    trans('plugins/job-board::messages.only_one_field_allowed', ['default' => 'Please provide either email OR phone number, not both.'])
                );
                $validator->errors()->add(
                    'phone',
                    trans('plugins/job-board::messages.only_one_field_allowed', ['default' => 'Please provide either email OR phone number, not both.'])
                );
            }
            
            // Check if neither field is filled
            if (empty($email) && empty($phone)) {
                $validator->errors()->add(
                    'email',
                    trans('plugins/job-board::messages.email_or_phone_required', ['default' => 'Please provide either email or phone number.'])
                );
            }
        });
    }
}
