<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EmailVerificationExpirationMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        abort_if(
            now() < $request->user()->email_verified_at->addDay(),
            403,
            __('auth.email.verify.delay', [
                'value' => $request->user()->email,
                'time' => now()->diffInHours($request->user()->email_verified_at)
            ])
        );

        return $next($request);
    }
}
