<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function index()
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

    public function accounts()
    {
        return Inertia::render('Profile/AccountsPage', [
            'auth_user' => Auth::check(),
            'user' => auth()->user()
        ]);
    }

    public function statistic()
    {
        return Inertia::render('Profile/StatisticPage', [
            'auth_user' => Auth::check(),
            'user' => auth()->user()
        ]);
    }

    public function workers()
    {
        return Inertia::render('Profile/WorkersPage', [
            'auth_user' => Auth::check(),
            'user' => auth()->user()
        ]);
    }

    public function connecting()
    {
        return Inertia::render('Profile/ConnectingPage', [
            'auth_user' => Auth::check(),
            'user' => auth()->user()
        ]);
    }

    public function wallets()
    {
        return Inertia::render('Profile/FullPages/WalletsPage', [
            'auth_user' => Auth::check(),
            'user' => auth()->user()
        ]);
    }

    public function referral(Request $request)
    {dd($request);
        if (!$request->page) {
            return redirect('/profile/referral?page=overview');
        }

        return Inertia::render(
            component: implode('/', ['Profile', 'Referral', ucfirst(Str::camel($request->page) . 'Page')]),
            props: [
                'auth_user' => Auth::check(),
                'user' => auth()->user()
            ]
        );
    }

    public function Income()
    {
        return Inertia::render('Profile/FullPages/IncomePage', [
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
    }
}
