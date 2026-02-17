<?php

namespace Botble\JobBoard\Http\Requests;

use Botble\Base\Facades\BaseHelper;
use Botble\Captcha\Facades\Captcha;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class ApplyJobRequest extends Request
{
    public function rules(): array
    {
        $rules = [
            'job_type' => Rule::in(['internal', 'external']),
            'email' => 'required|email',
            'message' => 'nullable|max:1000',
        ];

        if ($this->input('job_type') === 'internal') {
            $internalRules = [
                'full_name' => 'required|max:240|min:2',
                'email' => 'required|email',
                'phone' => 'nullable|' . BaseHelper::getPhoneValidationRule(),
                'screening_answers' => 'nullable|array',
                'screening_answers.*' => 'nullable|max:2000',
            ];

            // Message field - check if required
            if (setting('job_board_require_message_in_apply_job', false)) {
                $internalRules['message'] = 'required|max:1000';
            } else {
                $internalRules['message'] = 'nullable|max:1000';
            }

            // Resume field - check if required (only if user doesn't have existing resume)
            $account = auth('account')->user();
            if (setting('job_board_require_resume_in_apply_job', false) && (! $account || ! $account->resume)) {
                $internalRules['resume'] = 'required|file';
            } else {
                $internalRules['resume'] = 'nullable|file';
            }

            // Cover letter - optional (field removed from apply form; uses account's existing if any)
            $internalRules['cover_letter'] = 'nullable|file';

            $rules = array_merge($rules, $internalRules);
        }

        if (
            is_plugin_active('captcha') &&
            setting('enable_captcha') &&
            setting('job_board_enable_recaptcha_in_apply_job', 0)
        ) {
            $rules += Captcha::rules();
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'full_name' => trans('plugins/job-board::messages.full_name_label'),
            'email' => trans('plugins/job-board::messages.email_label'),
            'phone' => trans('plugins/job-board::messages.phone_attr'),
            'message' => trans('plugins/job-board::messages.message_label'),
            'resume' => trans('plugins/job-board::messages.resume_attr'),
            'cover_letter' => trans('plugins/job-board::messages.cover_letter_label'),
        ] + (is_plugin_active('captcha') ? Captcha::attributes() : []);
    }

    /**
     * Get the body parameters for API documentation.
     */
    public function bodyParameters(): array
    {
        return [
            'job_type' => [
                'description' => 'Type of job application (internal or external)',
                'example' => 'internal',
            ],
            'first_name' => [
                'description' => 'Applicant\'s first name',
                'example' => 'John',
            ],
            'last_name' => [
                'description' => 'Applicant\'s last name',
                'example' => 'Doe',
            ],
            'email' => [
                'description' => 'Applicant\'s email address',
                'example' => 'john.doe@example.com',
            ],
            'phone' => [
                'description' => 'Applicant\'s phone number',
                'example' => '+1234567890',
            ],
            'message' => [
                'description' => 'Cover message or additional information',
                'example' => 'I am very interested in this position...',
            ],
            'resume' => [
                'description' => 'Resume file upload',
                'example' => 'No-example',
            ],
            'cover_letter' => [
                'description' => 'Cover letter file upload',
                'example' => 'No-example',
            ],
        ];
    }
}
