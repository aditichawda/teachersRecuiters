<?php

namespace Botble\JobBoard\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Botble\ACL\Traits\SendsPasswordResetEmails;
use Botble\JobBoard\Forms\Fronts\Auth\ForgotPasswordForm;
use Botble\JobBoard\Http\Requests\Fronts\Auth\ForgotPasswordRequest;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        SeoHelper::setTitle(trans('plugins/job-board::messages.forgot_password'));

        Theme::breadcrumb()->add(trans('plugins/job-board::messages.forgot_password'), route('public.account.register'));

        $form = ForgotPasswordForm::create();
        if (session()->has('password_reset_email')) {
            $form->setModel(['email' => session('password_reset_email')]);
        }

        return Theme::scope('job-board.auth.passwords.email', ['form' => $form], 'plugins/job-board::themes.auth.passwords.email')->render();
    }

    public function sendResetLinkEmail(ForgotPasswordRequest $request)
    {
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }

    protected function sendResetLinkResponse($request, $response)
    {
        if ($request->wantsJson()) {
            return new \Illuminate\Http\JsonResponse(['message' => trans($response)], 200);
        }

        return back()
            ->with('status', trans($response))
            ->with('password_reset_email', $request->email);
    }

    public function broker()
    {
        return Password::broker('accounts');
    }
}
