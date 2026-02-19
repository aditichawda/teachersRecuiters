<?php

namespace Botble\JobBoard\Forms\Fronts;

use Botble\Base\Forms\FieldOptions\ButtonFieldOption;
use Botble\Base\Forms\FieldOptions\EmailFieldOption;
use Botble\Base\Forms\FieldOptions\FileFieldOption;
use Botble\Base\Forms\FieldOptions\HiddenFieldOption;
use Botble\Base\Forms\FieldOptions\HtmlFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\EmailField;
use Botble\Base\Forms\Fields\FileField;
use Botble\Base\Forms\Fields\HiddenField;
use Botble\Base\Forms\Fields\HtmlField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Captcha\Facades\Captcha;
use Botble\JobBoard\Http\Requests\ApplyJobRequest;
use Botble\JobBoard\Models\JobApplication;
use Botble\Media\Facades\RvMedia;
use Botble\Theme\FormFront;

class InternalJobApplicationForm extends FormFront
{
    protected string $errorBag = 'job_application';

    public static function formTitle(): string
    {
        return trans('plugins/job-board::messages.apply_for_this_job');
    }

    public function setup(): void
    {
        $account = auth('account')->user();

        $this
            ->contentOnly()
            ->setUrl(route('public.job.apply'))
            ->setMethod('POST')
            ->setFormOption('class', 'job-apply-form')
            ->setFormOption('files', true)
            ->setValidatorClass(ApplyJobRequest::class)
            ->model(JobApplication::class)

            // Modal header (compact)
            ->add('modal_header', HtmlField::class, HtmlFieldOption::make()->content('
                <div class="text-center mb-2">
                    <h2 class="modal-title h5 mb-0">' . trans('plugins/job-board::messages.apply_for_this_job') . '</h2>
                </div>
                <div class="position-absolute end-0 top-0 p-2">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            '))

            // Job info section (compact)
            ->add('job_info', HtmlField::class, HtmlFieldOption::make()->content('
                <div class="text-center mb-2">
                    <h5 class="modal-job-name text-primary small mb-0"></h5>
                </div>
            '))

            // Hidden fields
            ->add(
                'job_id',
                HiddenField::class,
                HiddenFieldOption::make()
                ->addAttribute('class', 'modal-job-id')
                ->required()
            )
            ->add(
                'job_type',
                HiddenField::class,
                HiddenFieldOption::make()
                ->value('internal')
            )

            // Step 1: Basic info + Screening
            ->add('step1_start', HtmlField::class, HtmlFieldOption::make()->content('<div id="apply-step-1" class="apply-step">'))

            // Full name + Phone in one row
            ->add('name_phone_row', HtmlField::class, HtmlFieldOption::make()->content('<div class="row g-2">'))
            ->add('full_name_col', HtmlField::class, HtmlFieldOption::make()->content('<div class="col-md-6">'))
            ->add('full_name', TextField::class, TextFieldOption::make()
                ->label(trans('plugins/job-board::messages.full_name_label'))
                ->value(old('full_name', $account ? trim(($account->first_name ?? '') . ' ' . ($account->last_name ?? '')) ?: ($account->full_name ?? $account->name ?? '') : ''))
                ->placeholder(trans('plugins/job-board::messages.enter_full_name'))
                ->required()
                ->addAttribute('id', 'full_name_apply_now')
            )
            ->add('full_name_col_end', HtmlField::class, HtmlFieldOption::make()->content('</div><div class="col-md-6">'))
            ->add(
                'phone',
                TextField::class,
                TextFieldOption::make()
                ->label(trans('plugins/job-board::forms.phone'))
                ->value(old('phone', $account?->phone ?? ''))
                ->placeholder(trans('plugins/job-board::messages.enter_phone_number'))
                ->required()
                ->addAttribute('id', 'phone_apply_now')
            )
            ->add('name_phone_row_end', HtmlField::class, HtmlFieldOption::make()->content('</div></div>'))

            // Email (visible – pre-filled when logged in)
            ->add('email', EmailField::class, EmailFieldOption::make()
                ->label(trans('plugins/job-board::messages.email_label'))
                ->value(old('email', $account?->email ?? ''))
                ->placeholder(trans('plugins/job-board::messages.email_address'))
                ->required()
                ->addAttribute('id', 'email_apply_now')
            )

            // Job Screening Questions (loaded by JS when modal opens)
            ->add('screening_questions_wrap', HtmlField::class, HtmlFieldOption::make()->content('
                <div id="job-screening-questions-wrap" class="job-apply-screening mb-3" style="display:none;">
                    <label class="form-label fw-semibold small">' . trans('plugins/job-board::messages.job_screening_questions') . '</label>
                    <div id="job-screening-questions-list"></div>
                </div>
            '))

            // Single step: screening + resume + submit (no Next/Back)
            ->add('step1_end', HtmlField::class, HtmlFieldOption::make()->content(''))

            // Resume field
            ->add(
                'resume',
                FileField::class,
                FileFieldOption::make()
                ->label($this->getResumeLabel($account))
                ->addAttribute('id', 'resume_apply_now')
                ->cssClass($account && $account->resume ? 'mb-2' : 'mb-2')
                ->when(setting('job_board_require_resume_in_apply_job', false) && (! $account || ! $account->resume), function (FileFieldOption $field) {
                    return $field->required();
                })
            );

        // Resume info if exists – short text with clickable filename
        if ($account && $account->resume) {
            $resumeUrl = RvMedia::url($account->resume);
            $resumeFilename = basename(str_replace('\\', '/', $account->resume));
            $displayName = strlen($resumeFilename) > 35 ? substr($resumeFilename, 0, 30) . '…' . substr($resumeFilename, -4) : $resumeFilename;
            $this->add('resume_info', HtmlField::class, HtmlFieldOption::make()->content('
                <div class="mb-2 mt-1">
                    <p class="job-apply-resume-info small text-muted mb-0">
                        ' . trans('plugins/job-board::messages.current_resume_short', [
                            'resume' => '<a href="' . e($resumeUrl) . '" target="_blank" rel="noopener">' . e($displayName) . '</a>',
                        ]) . '
                    </p>
                </div>
            '));
        }

        // Captcha if enabled
        if (is_plugin_active('captcha') && setting('enable_captcha') && setting('job_board_enable_recaptcha_in_apply_job', 0)) {
            $this->add('captcha', HtmlField::class, HtmlFieldOption::make()->content('
                <div class="mb-2">
                    ' . Captcha::display() . '
                </div>
            '));
        }

        $this
            // Submit button
            ->add(
                'submit',
                'submit',
                ButtonFieldOption::make()
                ->label(trans('plugins/job-board::messages.send_application'))
                ->cssClass('btn btn-primary w-100')
            )
            // Close apply-step-1 wrapper
            ->add('step2_end', HtmlField::class, HtmlFieldOption::make()->content('</div>'));
    }

    protected function getResumeLabel($account): string
    {
        $isRequired = setting('job_board_require_resume_in_apply_job', false);
        $hasExistingResume = $account && $account->resume;

        if ($hasExistingResume) {
            return trans('plugins/job-board::messages.resume_upload_optional');
        }

        if ($isRequired) {
            return trans('plugins/job-board::messages.resume_upload');
        }

        return trans('plugins/job-board::messages.resume_upload_optional');
    }

    protected function getCoverLetterLabel($account): string
    {
        $isRequired = setting('job_board_require_cover_letter_in_apply_job', false);
        $hasExistingCoverLetter = $account && $account->cover_letter;

        if ($hasExistingCoverLetter) {
            return trans('plugins/job-board::messages.cover_letter_optional');
        }

        if ($isRequired) {
            return trans('plugins/job-board::messages.cover_letter_upload');
        }

        return trans('plugins/job-board::messages.cover_letter_upload_optional');
    }
}
