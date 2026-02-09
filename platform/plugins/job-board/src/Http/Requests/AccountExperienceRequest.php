<?php

namespace Botble\JobBoard\Http\Requests;

use Botble\Support\Http\Requests\Request;

class AccountExperienceRequest extends Request
{
    public function rules(): array
    {
        return [
            'company' => ['required', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'employment_type' => ['nullable', 'string', 'in:full_time,part_time,contract,internship,freelance'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'started_at' => ['required', 'date'],
            'ended_at' => ['nullable', 'date'],
            'is_current' => ['nullable', 'boolean'],
        ];
    }
}
