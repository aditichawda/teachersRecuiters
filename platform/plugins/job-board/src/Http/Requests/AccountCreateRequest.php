<?php

namespace Botble\JobBoard\Http\Requests;

use Botble\Support\Http\Requests\Request;

class AccountCreateRequest extends Request
{
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'max:255', 'min:2'],
            'email' => ['required', 'max:60', 'min:6', 'email', 'unique:jb_accounts,email'],
            'password' => ['required', 'min:6', 'confirmed'],
            'unique_id' => ['nullable', 'string', 'unique:jb_accounts,unique_id'],
        ];
    }
}
