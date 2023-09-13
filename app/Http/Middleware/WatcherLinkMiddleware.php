<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Services\Internal\WatcherLinkService;
use Closure;
use Illuminate\Http\Request;

class WatcherLinkMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $accessKey = $request->header('X-Access-Key');

        if ($accessKey) {
            $isRouteAllowed = WatcherLinkService::isRouteAllowed(
                routeName: $request->route()->getName(),
                token: $accessKey
            );

            if ($isRouteAllowed) {
                $request->attributes->set('access_key_valid', true);

                return $next($request);
            }
        }

        return $next($request);
    }
}
