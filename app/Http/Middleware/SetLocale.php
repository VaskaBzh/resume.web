<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locale = $this->parseAcceptLanguageHeader($request->header('Accept-Language'));

        app()->setLocale($locale['lang'] ?? config('app.fallback_locale'));

        return $next($request);
    }

    public function parseAcceptLanguageHeader(string $header): ?array
    {
        return collect(explode(',', $header))
            ->map(function (string $item) {
                if (Str::contains($item, ';q=')) {
                    [$lang, $preference] = explode(';q=', $item);

                    return ['preference' => $preference, 'lang' => $lang];
                }
            })
            ->sortByDesc('preference')
            ->filter(fn ($locale) => $locale && in_array($locale['lang'], config('app.allowed_local')))
            ->first();
    }
}
