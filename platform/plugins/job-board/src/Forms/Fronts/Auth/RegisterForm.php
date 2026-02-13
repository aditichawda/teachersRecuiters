<?php

namespace Botble\JobBoard\Forms\Fronts\Auth;

use Botble\Base\Facades\Html;
use Botble\Base\Forms\FieldOptions\CheckboxFieldOption;
use Botble\Base\Forms\FieldOptions\OnOffFieldOption;
use Botble\Base\Forms\FieldOptions\PhoneNumberFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\Fields\EmailField;
use Botble\Base\Forms\Fields\HtmlField;
use Botble\Base\Forms\Fields\OnOffCheckboxField;
use Botble\Base\Forms\Fields\OnOffField;
use Botble\Base\Forms\Fields\PasswordField;
use Botble\Base\Forms\Fields\PhoneNumberField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormAbstract;
use Botble\JobBoard\Forms\Fronts\Auth\FieldOptions\EmailFieldOption;
use Botble\JobBoard\Forms\Fronts\Auth\FieldOptions\TextFieldOption;
use Botble\JobBoard\Http\Requests\Fronts\Auth\RegisterRequest;
use Botble\JobBoard\Models\Account;
use Botble\Location\Fields\Options\SelectLocationFieldOption;
use Botble\Location\Fields\SelectLocationField;

class RegisterForm extends AuthForm
{
    public function setup(): void
    {
        parent::setup();

        // Institution type options
        $institutionTypes = [
            'school' => 'School',
            'edtech-company' => 'Edtech Company',
            'online-education-platform' => 'Online Education Platform',
            'college' => 'College',
            'coaching-institute' => 'Coaching Institute',
            'book-publishing-company' => 'Book Publishing Company',
            'non-profit-organization' => 'Non Profit Organization',
        ];

        $this
            ->setUrl(route('public.account.register.sendVerificationCode'))
            ->setValidatorClass(RegisterRequest::class)
            ->setFormOption('enctype', 'multipart/form-data')
            // Step 1 Fields
          
            ->add('step_1_fields', HtmlField::class, [
                'html' => '<div class="step-content" data-step="1">',
            ])
            // Account Type Selection - TOP (Step 1)
            ->when(setting('job_board_enabled_register_as_employer', 1), function (FormAbstract $form): void {
                $form->add(
                    'account_type_selection',
                    HtmlField::class,
                    [
                        'html' => view('plugins/job-board::auth.partials.account-type-selection')->render(),
                    ]
                );
            })
            ->add('step_1_grid_open', HtmlField::class, [
                'html' => '<div class="row">',
            ])
            // Row 1: Full Name + Email (6/6)
            ->add('step_1_col_full_name_open', HtmlField::class, [
                'html' => '<div class="col-md-6">',
            ])
            ->add(
                'full_name',
                TextField::class,
                TextFieldOption::make()
                    ->label('Full Name')
                    ->placeholder('Enter your full name')
                    ->icon('ti ti-user')
                    ->required()
                    ->addAttribute('data-step', '1')
            )
            ->add('step_1_col_full_name_close', HtmlField::class, [
                'html' => '</div>',
            ])
            ->add('step_1_col_email_open', HtmlField::class, [
                'html' => '<div class="col-md-6">',
            ])
            ->add(
                'email',
                EmailField::class,
                EmailFieldOption::make()
                    ->label(trans('plugins/job-board::messages.email_label'))
                    ->placeholder(trans('plugins/job-board::messages.email_address_placeholder'))
                    ->icon('ti ti-mail')
                    ->required()
                    ->addAttribute('data-step', '1')
            )
            ->add('step_1_col_email_close', HtmlField::class, [
                'html' => '</div>',
            ])

            // Row 2: Mobile (+ WhatsApp toggle)
            ->add('step_1_col_phone_open', HtmlField::class, [
                'html' => '<div class="col-md-6">',
            ])
            ->add(
                'phone',
                PhoneNumberField::class,
                PhoneNumberFieldOption::make()
                    ->label('Mobile Number')
                    ->placeholder(trans('plugins/job-board::messages.phone_number_placeholder'))
                    ->withCountryCodeSelection()
                    ->required()
                    ->addAttribute('data-step', '1')
            )
            ->add(
                'is_whatsapp_available',
                OnOffField::class,
                OnOffFieldOption::make()
                ->label('&nbsp;Is this number available on WhatsApp?')
                ->defaultValue(false)
                    ->addAttribute('data-step', '1')
            )
            ->add('step_1_col_phone_close', HtmlField::class, [
                'html' => '</div>',
            ])

            // Row 3: Password
            ->add('step_1_col_password_open', HtmlField::class, [
                'html' => '<div class="col-md-6">',
            ])
            ->add(
                'password',
                PasswordField::class,
                TextFieldOption::make()
                    ->label(trans('plugins/job-board::messages.password'))
                    ->placeholder(trans('plugins/job-board::messages.password'))
                    ->icon('ti ti-lock')
                    ->required()
                    ->addAttribute('data-step', '1')
            )
            ->add('step_1_col_password_close', HtmlField::class, [
                'html' => '</div>',
            ])

            ->add('step_1_grid_close', HtmlField::class, [
                'html' => '</div>',
            ])
            ->add('step_1_end', HtmlField::class, [
                'html' => '</div>',
            ])
            // Step 2 Fields
            ->add('step_2_fields', HtmlField::class, [
                'html' => '<div class="step-content" data-step="2" style="display:none;">',
            ])
            ->add(
                'institution_type',
                SelectField::class,
                SelectFieldOption::make()
                    ->label('Institution Type')
                    ->choices(['' => 'Select Institution Type'] + $institutionTypes)
                    ->required()
                    ->addAttribute('data-step', '2')
                    ->addAttribute('id', 'institution_type')
            )
            // Note: institution_name field is in institution-type.blade.php view (only for employer)
            
            ->add('step_2_end', HtmlField::class, [
                'html' => '</div>',
            ])
            // Step 3 Fields - Only for Job Seekers
            ->add('step_3_fields', HtmlField::class, [
                'html' => '<div class="step-content" data-step="3" style="display:none;" id="step-3-job-seeker">',
            ])
            ->when(is_plugin_active('location'), function (FormAbstract $form): void {
                $form->add(
                    'location',
                    SelectLocationField::class,
                    SelectLocationFieldOption::make()
                        ->label('Location')
                        ->addAttribute('data-step', '3')
                        ->addAttribute('data-account-type', 'job-seeker')
                );
            })
            ->add(
                'location_type',
                SelectField::class,
                SelectFieldOption::make()
                    ->label('Location Type')
                    ->choices([
                        '' => 'Select Location Type',
                        'current' => 'Current Location',
                        'native' => 'Native Location',
                    ])
                    ->required()
                    ->addAttribute('data-step', '3')
                    ->addAttribute('data-account-type', 'job-seeker')
            )
            // Field 23: Educational Institutions (up to 3 with priority)
            ->add('educational_institutions_section', HtmlField::class, [
                'html' => view('plugins/job-board::auth.partials.educational-institutions')->render(),
            ])
            
            // Field 24: Position Type (Teaching/Non-Teaching)
            ->add('position_type_section', HtmlField::class, [
                'html' => view('plugins/job-board::auth.partials.position-type')->render(),
            ])
            
            // Field 25: Teaching Subject or Post (up to 3 with priority)
            ->add('teaching_subject_post_section', HtmlField::class, [
                'html' => view('plugins/job-board::auth.partials.teaching-subject-post')->render(),
            ])
            
            // Field 26: Job Type
            ->add('job_type_section', HtmlField::class, [
                'html' => view('plugins/job-board::auth.partials.job-type')->render(),
            ])
            
            ->add('step_3_end', HtmlField::class, [
                'html' => '</div>',
            ])
            // Step 3 Fields for Employers (if needed in future)
            ->add('step_3_employer_fields', HtmlField::class, [
                'html' => '<div class="step-content" data-step="3" style="display:none;" id="step-3-employer">',
            ])
            ->add('step_3_employer_end', HtmlField::class, [
                'html' => '</div>',
            ])
            ->submitButton(trans('plugins/job-board::messages.register'), 'ti ti-arrow-narrow-right')
            ->add('login', HtmlField::class, [
                'html' => sprintf(
                    '<div class="mt-3 text-center">%s <a href="%s" class="text-decoration-underline">%s</a></div>',
                    trans('plugins/job-board::messages.already_have_account'),
                    route('public.account.login'),
                    trans('plugins/job-board::messages.sign_in')
                ),
            ])
            ->add('filters', HtmlField::class, [
                'html' => apply_filters(BASE_FILTER_AFTER_LOGIN_OR_REGISTER_FORM, null, Account::class),
            ]);
    }
}
