<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function __invoke(Request $request, string $page)
    {
        $queryable = $request->query('page');
        $user = auth()->user();

        Inertia::render(
            component: Arr::get(config('inertia.components.profile'), $queryable ?? $page, 'StatisticPage'),
            props: [
                'auth_user' => Auth::check(),
                'user' => $user,
                'referral_code' => User::whereNotNull('referral_code')
                    ->find($user?->owners->first()?->user_id)
                    ?->referral_code['code'],
                "token" => csrf_token(),
            ]
        );
    }
}
