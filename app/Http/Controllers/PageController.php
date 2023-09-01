<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PageController extends Controller
{
    public function index()
    {
        return Inertia::render(
            component: Arr::get(config('inertia.components'), 'home', 'HomePage')
        );
    }

    public function show(Request $request, string $page)
    {
        $queryable = $request->query('page');
        $user = auth()->user();

        return match (true) {
            Str::is($page, 'profile') => redirect('/profile/statistic'),
            Str::is($page, 'referral') && !$queryable => redirect('/profile/referral?page=overview'),
            default => Inertia::render(
                component: Arr::get(config('inertia.components'), $queryable ?? $page, 'HomePage'),
                props: [
                    'auth_user' => Auth::check(),
                    'user' => $user,
                    'referral_code' => User::whereNotNull('referral_code')
                        ->find($user?->owners->first()?->user_id)
                        ?->referral_code['code'],
                    "token" => csrf_token(),
                ]
            )
        };
    }
}
