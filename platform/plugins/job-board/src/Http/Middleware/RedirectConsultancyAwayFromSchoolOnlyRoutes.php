<?php

namespace Botble\JobBoard\Http\Middleware;

use Botble\JobBoard\Models\Account;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectConsultancyAwayFromSchoolOnlyRoutes
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('account')->user();
        if (! $user || ! $user->isEmployer()) {
            return $next($request);
        }

        $account = $user->getKey() ? Account::find($user->getKey()) : null;
        if (! $account || ! $account->isConsultancy()) {
            return $next($request);
        }

        $routeName = $request->route()?->getName() ?? '';
        $forbidden = [
            'public.account.companies.index',
            'public.account.companies.create',
            'public.account.companies.store',
            'public.account.companies.show',
            'public.account.companies.edit',
            'public.account.companies.update',
            'public.account.companies.destroy',
            'public.account.team-members.index',
            'public.account.team-members.store',
        ];

        if (in_array($routeName, $forbidden, true) || str_starts_with($routeName, 'public.account.companies.') || str_starts_with($routeName, 'public.account.team-members.')) {
            return redirect()->route('public.account.dashboard');
        }

        return $next($request);
    }
}
