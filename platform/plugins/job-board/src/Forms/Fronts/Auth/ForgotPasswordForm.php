<?php

namespace Botble\JobBoard\Forms\Fronts\Auth;

use Botble\Base\Forms\Fields\EmailField;
use Botble\JobBoard\Forms\Fronts\Auth\FieldOptions\EmailFieldOption;
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
                    ->placeholder(trans('plugins/job-board::messages.email_address_placeholder'))
                    ->icon('ti ti-mail')
            )
            ->submitButton(trans('plugins/job-board::messages.send_password_reset_link'));
    }
}
