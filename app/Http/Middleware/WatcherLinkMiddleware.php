<?php

namespace App\Http\Middleware;

use App\Models\WatcherLink;
use App\Services\Internal\WatcherLinkService;
use Closure;
use Illuminate\Http\Request;

class WatcherLinkMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $accessKey = $request->header('X-Access-Key');

        if (!$accessKey) {
            return $next($request);
        }

        if (!$this->isValidAccessKey($accessKey)) {
            return $next($request);
        }

        /*$isAllowed = WatcherLinkService::isAllowedRoute($accessKey, $request->segments());

        dd('sss');*/
    }

    private function isValidAccessKey(string $accessKey): bool
    {
        return WatcherLink::where('token', $accessKey)->exists();
    }
}
