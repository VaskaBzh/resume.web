<?php

declare(strict_types=1);

namespace App\Http\Controllers\Referral;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Inertia\Inertia;

class ShowController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = $request->query('page');
        if (!$query) {
            return redirect('/profile/referral?page=overview');
        }

        $user = auth()->user();

        return Inertia::render(
            component: Arr::get(config('inertia.components.profile.referral'), $query, 'ErrorPage'),
            props: [
                'has_referral_role' => $user->hasRole('referral'),
                'user' => $user,
                "token" => csrf_token(),
            ]
        );
    }
}