<?php

namespace Botble\JobBoard\Http\Middleware;

use Botble\Theme\Facades\AdminBar;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAccount
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('account')->check()) {
            $account = Auth::guard('account')->user();
            
            // Redirect employers to employer dashboard, job seekers to job seeker dashboard
            if ($account->isEmployer()) {
                return redirect(route('public.account.dashboard'));
            } else {
                return redirect(route('public.account.jobseeker.dashboard'));
            }
        }

        AdminBar::setIsDisplay(false);

        return $next($request);
    }
}
