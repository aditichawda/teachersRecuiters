<?php

namespace Botble\JobBoard\Http\Requests;

use Botble\JobBoard\Models\Account;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class AccountJobRequest extends JobRequest
{
    public function rules(): array
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();
        $companyIds = $account && $account->companies ? $account->companies->pluck('id')->all() : [];

        $rules = parent::rules();
        Arr::forget($rules, 'moderation_status');

        return array_merge($rules, [
            'company_id' => [
                'required',
                Rule::in(array_values($companyIds)),
            ],
            'job_type_category' => ['required', 'in:teaching,non-teaching'],
            'content' => ['required', 'string', 'min:10'],
            'degree_level_id' => ['nullable', 'integer', 'exists:jb_degree_levels,id'],
            'job_experience_id' => ['nullable', 'integer', 'exists:jb_job_experiences,id'],
            'required_certifications' => ['nullable', 'string'],
            'gender_preference' => ['nullable', 'in:male,female'],
            'marital_status_preference' => ['nullable', 'in:married,single,other'],
            'application_location_type' => ['nullable', 'in:nearby,specific,anywhere'],
            'application_locations' => ['nullable', 'string'],
            'language_proficiency' => ['nullable', 'string'],
            'apply_type' => ['nullable', 'in:internal,external'],
            'apply_internal_emails' => ['nullable', 'array', 'max:3'],
            'apply_internal_emails.*' => ['nullable', 'email', 'max:255'],
            'apply_internal_phones' => ['nullable', 'array', 'max:3'],
            'apply_internal_phones.*' => ['nullable', 'string', 'max:20'],
            'is_remote' => ['nullable'],
            'hide_company' => ['nullable'],
            'hide_salary' => ['nullable'],
            'job_shift_id' => ['nullable', 'integer'],
            'screening_question_ids' => ['nullable', 'array'],
            'screening_question_ids.*' => ['integer', 'exists:jb_screening_questions,id'],
            'screening_question_required' => ['nullable', 'array'],
            'screening_question_required.*' => ['integer', 'exists:jb_screening_questions,id'],
            'screening_question_question' => ['nullable', 'array'],
            'screening_question_question.*' => ['nullable', 'string', 'max:2000'],
            'screening_question_options' => ['nullable', 'array'],
            'screening_question_options.*' => ['nullable', 'string', 'max:2000'],
            'screening_question_correct' => ['nullable', 'array'],
            'screening_question_correct.*' => ['nullable', 'string', 'max:500'],
        ]);
    }

    public function messages(): array
    {
        return [
            'company_id.required' => trans('plugins/job-board::messages.must_add_company_first'),
        ];
    }

    /**
     * Get the body parameters for API documentation.
     */
    public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'Job title',
                'example' => 'Senior Software Engineer',
            ],
            'description' => [
                'description' => 'Job description',
                'example' => 'We are looking for a senior software engineer...',
            ],
            'content' => [
                'description' => 'Detailed job content',
                'example' => 'Full job description with requirements...',
            ],
            'company_id' => [
                'description' => 'ID of the company posting the job',
                'example' => 1,
            ],
            'salary_from' => [
                'description' => 'Minimum salary',
                'example' => 50000,
            ],
            'salary_to' => [
                'description' => 'Maximum salary',
                'example' => 80000,
            ],
            'salary_type' => [
                'description' => 'Type of salary (fixed, negotiable, competitive, hidden)',
                'example' => 'fixed',
            ],
            'number_of_positions' => [
                'description' => 'Number of open positions',
                'example' => 2,
            ],
            'expire_date' => [
                'description' => 'Job expiration date',
                'example' => '2024-12-31',
            ],
        ];
    }
}
