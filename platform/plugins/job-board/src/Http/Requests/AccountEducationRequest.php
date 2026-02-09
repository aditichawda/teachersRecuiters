<?php

namespace Botble\JobBoard\Http\Requests;

use Botble\Support\Http\Requests\Request;

class AccountEducationRequest extends Request
{
    public function rules(): array
    {
        return [
            'school' => ['required', 'string', 'max:255'],
            'level' => ['nullable', 'string', 'in:diploma,bachelors,masters,doctorate'],
            'specialized' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'started_at' => ['required', 'date'],
            'ended_at' => ['nullable', 'date'],
            'is_current' => ['nullable', 'boolean'],
        ];
    }
}
