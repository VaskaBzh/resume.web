<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function profile(): RedirectResponse
    {
        return redirect()->route('statistic');
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

    public function ref()
    {
        return Inertia::render('Profile/ReferralPage', [
            'auth_user' => Auth::check(),
            'user' => auth()->user()
        ]);
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
        return Inertia::render('Profile/FullPages/SettingsPage', [
            'auth_user' => Auth::check(),
            'user' => auth()->user()
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
