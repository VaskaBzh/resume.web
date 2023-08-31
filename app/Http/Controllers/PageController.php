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

    public function __invoke(Request $request, string $page)
    {
        return Inertia::render(
            component: Arr::get(config('inertia.components'), $page, 'HomePage'),
            props: [
                'auth_user' => Auth::check(),
                'user' => auth()->user()
            ]
        );
    }

    /*public function index()
    {
        return Inertia::render('HomePage', [
            'title' => 'Allbtc',
            'auth_user' => Auth::check(),
            'user' => auth()->user()
        ]);
    }

    public function confirm()
    {
        return Inertia::render('Auth/ConfirmPage', [
            'auth_user' => Auth::check(),
            'user' => auth()->user()
        ]);
    }

    public function login()
    {
        return Inertia::render('Auth/LoginPage', [
            'auth_user' => Auth::check(),
            'user' => auth()->user()
        ]);
    }

    public function registration()
    {
        return Inertia::render('Auth/RegPage', [
            'auth_user' => Auth::check(),
            'user' => auth()->user()
        ]);
    }

    public function hosting()
    {
        return Inertia::render('HostingPage', [
            'auth_user' => Auth::check(),
            'user' => auth()->user()
        ]);
    }

    public function help()
    {
        return Inertia::render('FaqPage', [
            'auth_user' => Auth::check(),
            'user' => auth()->user()
        ]);
    }

    public function calculator()
    {
        return Inertia::render('CalculatorPage', [
            'auth_user' => Auth::check(),
            'user' => auth()->user()
        ]);
    }

    public function settings()
    {
        $user = auth()->user();

        $ownerUser = User::whereNotNull('referral_code')
            ->find($user?->owners->first()?->user_id);

        return Inertia::render('Profile/FullPages/SettingsPage', [
            'auth_user' => Auth::check(),
            'user' => $user,
            'referral_code' => $ownerUser?->referral_code['code']
        ]);
    }

    public function twoFactorAuth()
    {
        $rendered = Inertia::render('Auth/TwoFactorVerifyPage', [
            'qrCode' => session()->get('qrCode'),
            'secret' => session()->get('secret')
        ]);

        session()->forget('qrCode');
        session()->forget('secret');

        return $rendered;
    }*/
}
