<?php

namespace Botble\JobBoard\Forms\Fronts;

use Botble\Base\Forms\FieldOptions\ButtonFieldOption;
use Botble\Base\Forms\FieldOptions\EmailFieldOption;
use Botble\Base\Forms\FieldOptions\FileFieldOption;
use Botble\Base\Forms\FieldOptions\HiddenFieldOption;
use Botble\Base\Forms\FieldOptions\HtmlFieldOption;
use Botble\Base\Forms\FieldOptions\TextareaFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\EmailField;
use Botble\Base\Forms\Fields\FileField;
use Botble\Base\Forms\Fields\HiddenField;
use Botble\Base\Forms\Fields\HtmlField;
use Botble\Base\Forms\Fields\TextareaField;
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

            // Full name (single field; backend will split to first_name + last_name)
            ->add('full_name', TextField::class, TextFieldOption::make()
                ->label(trans('plugins/job-board::messages.full_name_label'))
                ->value(old('full_name', ($account ? trim(($account->first_name ?? '') . ' ' . ($account->last_name ?? '')) : '')))
                ->placeholder(trans('plugins/job-board::messages.enter_full_name'))
                ->required()
                ->addAttribute('id', 'full_name_apply_now')
            )

            // Email (hidden – not shown, sent at submit from account)
            ->add('email', HiddenField::class, HiddenFieldOption::make()
                ->value(old('email', $account->email ?? ''))
                ->addAttribute('id', 'email_apply_now')
            )

            // Contact row: Phone only (email hidden above)
            ->add('contact_row_start', HtmlField::class, HtmlFieldOption::make()->content('<div class="row g-2">'))
            ->add('phone_col_start', HtmlField::class, HtmlFieldOption::make()->content('<div class="col-12">'))
            ->add(
                'phone',
                TextField::class,
                TextFieldOption::make()
                ->label(trans('plugins/job-board::forms.phone'))
                ->value(old('phone', $account->phone ?? ''))
                ->placeholder(trans('plugins/job-board::messages.enter_phone_number'))
                ->required()
                ->addAttribute('id', 'phone_apply_now')
            )
            ->add('phone_col_end', HtmlField::class, HtmlFieldOption::make()->content('</div>'))
            ->add('contact_row_end', HtmlField::class, HtmlFieldOption::make()->content('</div>'))

            // Job Screening Questions (loaded by JS when modal opens)
            ->add('screening_questions_wrap', HtmlField::class, HtmlFieldOption::make()->content('
                <div id="job-screening-questions-wrap" class="job-apply-screening mb-2" style="display:none;">
                    <label class="form-label fw-semibold small">' . trans('plugins/job-board::messages.job_screening_questions') . '</label>
                    <div id="job-screening-questions-list"></div>
                </div>
            '))

            // Message field (compact)
            ->add(
                'message',
                TextareaField::class,
                TextareaFieldOption::make()
                ->label(trans('plugins/job-board::messages.message_label'))
                ->placeholder(trans('plugins/job-board::messages.enter_message'))
                ->rows(3)
                ->addAttribute('id', 'message_apply_now')
                ->when(setting('job_board_require_message_in_apply_job', false), function (TextareaFieldOption $field) {
                    return $field->required();
                })
            )

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

        // Resume info if exists
        if ($account && $account->resume) {
            $this->add('resume_info', HtmlField::class, HtmlFieldOption::make()->content('
                <div class="mb-2 mt-1">
                    <p class="job-apply-resume-info small text-muted mb-0">
                        <i class="mdi mdi-information-outline"></i>
                        ' . trans('plugins/job-board::messages.current_resume_message', [
                            'resume' => '<a href="' . RvMedia::url($account->resume) . '" target="_blank">' . $account->resume . '</a>',
                        ]) . '
                    </p>
                </div>
            '));
        }

        $this
            // Cover letter field
            ->add(
                'cover_letter',
                FileField::class,
                FileFieldOption::make()
                ->label($this->getCoverLetterLabel($account))
                ->addAttribute('id', 'cover_letter_apply_now')
                ->cssClass($account && $account->cover_letter ? 'mb-2' : 'mb-2')
                ->when(setting('job_board_require_cover_letter_in_apply_job', false) && (! $account || ! $account->cover_letter), function (FileFieldOption $field) {
                    return $field->required();
                })
            );

        // Cover letter info if exists
        if ($account && $account->cover_letter) {
            $this->add('cover_letter_info', HtmlField::class, HtmlFieldOption::make()->content('
                <div class="mb-2 mt-1">
                    <p class="job-apply-resume-info small text-muted mb-0">
                        <i class="mdi mdi-information-outline"></i>
                        ' . trans('plugins/job-board::messages.current_cover_letter_message', [
                            'cover_letter' => '<a href="' . RvMedia::url($account->cover_letter) . '" target="_blank">' . $account->cover_letter . '</a>',
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
            );
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
