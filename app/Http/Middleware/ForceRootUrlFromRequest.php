<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

/**
 * Keeps generated asset() / url() in sync with how the user actually opened the site.
 * Fixes admin (and front) missing CSS when APP_URL is e.g. 127.0.0.1:8000 but the
 * site is served under XAMPP as http://localhost/Aditi/public (or vice versa).
 */
class ForceRootUrlFromRequest
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! empty(env('FORCE_ROOT_URL'))) {
            return $next($request);
        }

        $root = rtrim($request->root(), '/');
        if ($root !== '') {
            URL::forceRootUrl($root);
        }

        return $next($request);
    }
}
