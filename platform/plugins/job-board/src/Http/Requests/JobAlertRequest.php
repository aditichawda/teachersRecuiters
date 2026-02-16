<?php

namespace Botble\JobBoard\Http\Requests;

use Botble\Support\Http\Requests\Request;

class JobAlertRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'keywords' => ['nullable', 'string', 'max:500'],
            'job_category_id' => ['nullable', 'exists:jb_categories,id'],
            'job_type_id' => ['nullable', 'exists:jb_job_types,id'],
            'country_id' => ['nullable', 'exists:countries,id'],
            'state_id' => ['nullable', 'exists:states,id'],
            'city_id' => ['nullable', 'exists:cities,id'],
            'salary_from' => ['nullable', 'numeric', 'min:0'],
            'salary_to' => ['nullable', 'numeric', 'min:0', 'gte:salary_from'],
            'frequency' => ['required', 'in:instant,daily,weekly'],
        ];
    }
}
