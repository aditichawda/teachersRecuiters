<?php

namespace Botble\JobBoard\Forms\Fronts\Auth;

use Botble\Base\Facades\Html;
use Botble\Base\Forms\FieldOptions\CheckboxFieldOption;
use Botble\Base\Forms\Fields\HtmlField;
use Botble\Base\Forms\Fields\OnOffCheckboxField;
use Botble\Base\Forms\Fields\PasswordField;
use Botble\Base\Forms\Fields\TextField;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Forms\Fronts\Auth\FieldOptions\TextFieldOption;
use Botble\JobBoard\Http\Requests\Fronts\Auth\LoginRequest;
use Botble\JobBoard\Models\Account;

class LoginForm extends AuthForm
{
    public function setup(): void
    {
        parent::setup();

        $this
            ->setUrl(route('public.account.login.post'))
            ->setValidatorClass(LoginRequest::class)
            ->add(
                'email',
                TextField::class,
                TextFieldOption::make()
                    ->label(trans('plugins/job-board::messages.email_or_phone_label'))
                    ->placeholder(trans('plugins/job-board::messages.email_or_phone_placeholder'))
                    ->helperText(trans('plugins/job-board::messages.email_or_phone_login_hint'))
                    ->icon('ti ti-mail')
            )
            ->add(
                'password',
                PasswordField::class,
                TextFieldOption::make()
                    ->label(trans('plugins/job-board::messages.password'))
                    ->placeholder(trans('plugins/job-board::messages.password'))
                    ->icon('ti ti-lock')
            )
            ->add('openRow', HtmlField::class, [
                'html' => '<div class="row g-0 mb-3">',
            ])
            ->add(
                'remember',
                OnOffCheckboxField::class,
                CheckboxFieldOption::make()
                    ->label(trans('plugins/job-board::messages.remember_me'))
                    ->wrapperAttributes(['class' => 'col-6'])
            )
            ->add(
                'forgot_password',
                HtmlField::class,
                [
                    'html' => Html::link(route('public.account.password.request'), trans('plugins/job-board::messages.forgot_password_link'), attributes: ['class' => 'text-decoration-underline']),
                    'wrapper' => [
                        'class' => 'col-6 text-end',
                    ],
                ]
            )
            ->add('closeRow', HtmlField::class, [
                'html' => '</div>',
            ])
            ->setFormEndKey('remember')
            ->submitButton(trans('plugins/job-board::messages.login'), 'ti ti-arrow-narrow-right')
            ->when(JobBoardHelper::isRegisterEnabled(), function (LoginForm $form): void {
                $employerEnabled = (bool) setting('job_board_enabled_register_as_employer', true);
                $jobSeekerLink = '<a href="' . route('public.account.register') . '" class="text-decoration-underline">' . trans('plugins/job-board::messages.register_as_job_seeker') . '</a>';
                $employerLink = $employerEnabled
                    ? ' ' . trans('plugins/job-board::messages.or') . ' <a href="' . route('public.account.register.employer') . '" class="text-decoration-underline">' . trans('plugins/job-board::messages.register_as_employer') . '</a>'
                    : '';
                $intro = trans('plugins/job-board::messages.dont_have_account_signup_as');
                $form->add('register', HtmlField::class, [
                    'html' => '<div class="mt-3 text-center"><span class="text-muted">' . $intro . '</span> ' . $jobSeekerLink . $employerLink . '</div>',
                ]);
            })
            ->add('filters', HtmlField::class, [
                'html' => apply_filters(BASE_FILTER_AFTER_LOGIN_OR_REGISTER_FORM, null, Account::class),
            ]);
    }
}
