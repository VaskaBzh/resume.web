<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EmailVerificationExpirationMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (now() < $request->user()->email_verified_at->addDay()) {
            abort(403, 'Your email confirmed, please wait 24 hours for full access');
        }

        return $next($request);
    }
}
