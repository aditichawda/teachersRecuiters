<?php

namespace Botble\JobBoard\Http\Requests\Fronts\Auth;

use Botble\Base\Rules\EmailRule;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rules\Password;

class EmployerRegisterRequest extends Request
{
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'max:60', new EmailRule()],
            'phone' => ['required', 'string', 'max:25'],
            'is_whatsapp_available' => ['nullable', 'boolean'],
            'password' => ['required', Password::min(6)],
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'Please enter your full name.',
            'email.required' => 'Please enter your email address.',
            'phone.required' => 'Please enter your mobile number.',
            'password.required' => 'Please enter a password.',
        ];
    }
}
