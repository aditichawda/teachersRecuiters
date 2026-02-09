<?php

namespace Botble\JobBoard\Forms\Fronts\Auth;

use Botble\Base\Forms\FieldOptions\OnOffFieldOption;
use Botble\Base\Forms\FieldOptions\PhoneNumberFieldOption;
use Botble\Base\Forms\Fields\EmailField;
use Botble\Base\Forms\Fields\HtmlField;
use Botble\Base\Forms\Fields\OnOffField;
use Botble\Base\Forms\Fields\PasswordField;
use Botble\Base\Forms\Fields\PhoneNumberField;
use Botble\Base\Forms\Fields\TextField;
use Botble\JobBoard\Forms\Fronts\Auth\FieldOptions\EmailFieldOption;
use Botble\JobBoard\Forms\Fronts\Auth\FieldOptions\TextFieldOption;
use Botble\JobBoard\Http\Requests\Fronts\Auth\EmployerRegisterRequest;
use Botble\JobBoard\Models\Account;

class EmployerRegisterForm extends AuthForm
{
    public function setup(): void
    {
        parent::setup();

        $this
            ->setUrl(route('public.account.register.employer.post'))
            ->setValidatorClass(EmployerRegisterRequest::class)
            ->setFormOption('enctype', 'multipart/form-data')
            
            // Hidden account type field
            ->add('account_type', HtmlField::class, [
                'html' => '<input type="hidden" name="account_type" value="employer">',
            ])
            
            ->add('form_grid_open', HtmlField::class, [
                'html' => '<div class="row">',
            ])
            
            // Row 1: Full Name (full width)
            ->add('col_full_name_open', HtmlField::class, [
                'html' => '<div class="col-md-12">',
            ])
            ->add(
                'full_name',
                TextField::class,
                TextFieldOption::make()
                    ->label('Full Name')
                    ->placeholder('Enter your full name')
                    ->icon('ti ti-user')
                    ->required()
            )
            ->add('col_full_name_close', HtmlField::class, [
                'html' => '</div>',
            ])
            
            // Row 2: Email + Mobile (6/6)
            ->add('col_email_open', HtmlField::class, [
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
            )
            ->add('col_email_close', HtmlField::class, [
                'html' => '</div>',
            ])
            ->add('col_phone_open', HtmlField::class, [
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
            )
            ->add('col_phone_close', HtmlField::class, [
                'html' => '</div>',
            ])
            
            // WhatsApp toggle
            ->add('col_whatsapp_open', HtmlField::class, [
                'html' => '<div class="col-md-12">',
            ])
            ->add(
                'is_whatsapp_available',
                OnOffField::class,
                OnOffFieldOption::make()
                    ->label('Is this number available on WhatsApp?')
                    ->defaultValue(false)
            )
            ->add('col_whatsapp_close', HtmlField::class, [
                'html' => '</div>',
            ])

            // Row 3: Password
            ->add('col_password_open', HtmlField::class, [
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
            )
            ->add('col_password_close', HtmlField::class, [
                'html' => '</div>',
            ])

            ->add('form_grid_close', HtmlField::class, [
                'html' => '</div>',
            ])
            
            ->submitButton('Next Step', 'ti ti-arrow-right')
            ->add('login', HtmlField::class, [
                'html' => sprintf(
                    '<div class="mt-3 text-center">%s <a href="%s" class="text-decoration-underline">%s</a></div>',
                    trans('plugins/job-board::messages.already_have_account'),
                    route('public.account.login'),
                    trans('plugins/job-board::messages.sign_in')
                ),
            ])
            ->add('job_seeker_link', HtmlField::class, [
                'html' => sprintf(
                    '<div class="mt-2 text-center"><span>Looking for a job?</span> <a href="%s" class="text-decoration-underline">Register as Job Seeker</a></div>',
                    route('public.account.register')
                ),
            ])
            ->add('filters', HtmlField::class, [
                'html' => apply_filters(BASE_FILTER_AFTER_LOGIN_OR_REGISTER_FORM, null, Account::class),
            ]);
    }
}
