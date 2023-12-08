<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locale = $this->parseAcceptLanguageHeader($request->header('Accept-Language') ?? '');

        app()->setLocale($locale['lang'] ?? config('app.fallback_locale'));

        return $next($request);
    }

    /**
     * @return array|null{
     *     preference: float|string,
     *     lang: string
     * }
     */
    public function parseAcceptLanguageHeader(string $header): ?array
    {
        return collect(explode(',', $header))
            ->map(function (string $locale) {
                if (Str::contains($locale, ';q=')) {
                    [$lang, $preference] = explode(';q=', $locale);

                    return ['preference' => $preference, 'lang' => $lang];
                }
            })->sortByDesc('preference')
            ->filter(fn ($locale) => $locale && in_array($locale['lang'], config('app.allowed_local')))
            ->first();
    }
}
