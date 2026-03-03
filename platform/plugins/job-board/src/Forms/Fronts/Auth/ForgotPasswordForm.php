<?php

namespace Botble\JobBoard\Forms\Fronts\Auth;

use Botble\Base\Forms\FieldOptions\HtmlFieldOption;
use Botble\Base\Forms\Fields\EmailField;
use Botble\Base\Forms\Fields\HtmlField;
use Botble\Base\Forms\Fields\TextField;
use Botble\JobBoard\Forms\Fronts\Auth\FieldOptions\EmailFieldOption;
use Botble\JobBoard\Forms\Fronts\Auth\FieldOptions\TextFieldOption;
use Botble\JobBoard\Http\Requests\Fronts\Auth\ForgotPasswordRequest;

class ForgotPasswordForm extends AuthForm
{
    public function setup(): void
    {
        parent::setup();

        $this
            ->setUrl(route('public.account.password.email'))
            ->setValidatorClass(ForgotPasswordRequest::class)
            ->add(
                'email',
                EmailField::class,
                EmailFieldOption::make()
                    ->label(trans('plugins/job-board::messages.email_label'))
                    ->placeholder('Please enter email')
                    ->icon('ti ti-mail')
            )
            ->add(
                'or_divider',
                HtmlField::class,
                HtmlFieldOption::make()
                    ->content('<div class="fp-or-divider"><span>OR</span></div>')
            )
            ->add(
                'phone',
                TextField::class,
                TextFieldOption::make()
                    ->label(trans('plugins/job-board::messages.phone_label', ['default' => 'Phone Number']))
                    ->placeholder('Please enter phone number')
                    ->icon('ti ti-phone')
            )
            ->submitButton(trans('plugins/job-board::messages.send_password_reset_link'));
    }
}
