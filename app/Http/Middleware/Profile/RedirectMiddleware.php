<?php

namespace App\Http\Middleware\Profile;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RedirectMiddleware
{
    public function handle(Request $request, Closure $next)
    {dd($request);
        return match ($request->getRequestUri()) {
            //'/profile' => redirect('/profile/statistic'),
            '/referral' => redirect('/profile/referral?page=overview'),
            default => $next($request)
        };
    }
}
