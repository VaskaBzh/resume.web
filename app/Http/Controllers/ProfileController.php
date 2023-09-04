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
    public function __invoke(Request $request, ?string $page = null)
    {
        $user = auth()->user();

        return Inertia::render(
            component: Arr::get(config('inertia.components.profile'), $page, 'ErrorPage'),
            props: [
                'auth_user' => Auth::check(),
                'user' => $user,
                'has_referral_role' => $user->hasRole('referral'),
                "token" => csrf_token(),
            ]
        );
    }
}
