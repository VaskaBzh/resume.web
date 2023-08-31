<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PageController extends Controller
{

    public function index()
    {
        return Inertia::render(
            component: Arr::get(config('inertia.components'), 'home', 'HomePage'),
            props: [
                'auth_user' => Auth::check(),
                'user' => auth()->user()
            ]
        );
    }

    public function show(Request $request, string $page)
    {
        $queryable = $request->query('page');

        return match (true) {
            $page === 'profile' => redirect('/profile/statistic'),
            $page === 'referral' && !$queryable => redirect('/profile/referral?page=overview'),
            default => Inertia::render(
                component: Arr::get(config('inertia.components'), $queryable ?? $page, 'HomePage'),
                props: [
                    'auth_user' => Auth::check(),
                    'user' => auth()->user(),
                    "token" => csrf_token()
                ]
            )
        };
    }
}
