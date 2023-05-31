<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function index()
    {
        return Inertia::render('HomePage', [
            'title' => 'Allbtc',
            'auth_user' => Auth::check(),
        ]);
    }

    public function complexity()
    {
        return Inertia::render('ComplexityPage', [
            'auth_user' => Auth::check(),
        ]);
    }

    public function hostings()
    {
        return Inertia::render('HostingPage', [
            'auth_user' => Auth::check(),
        ]);
    }

//    public function help()
//    {
//        return Inertia::render('FaqPage', [
//            'auth_user' => Auth::check(),
//        ]);
//    }

//    public function about()
//    {
//        return Inertia::render('AboutPage', [
//            'auth_user' => Auth::check(),
//        ]);
//    }


    public function profile()
    {
        return Inertia::render('Profile/ProfilePage', [
            'auth_user' => Auth::check(),
        ]);
    }

    public function accounts()
    {
        return Inertia::render('Profile/AccountsPage', [
            'auth_user' => Auth::check(),
        ]);
    }

    public function statistic()
    {
        return Inertia::render('Profile/StatisticPage', [
            'auth_user' => Auth::check(),
        ]);
    }

    public function workers()
    {
        return Inertia::render('Profile/WorkersPage', [
            'auth_user' => Auth::check(),
        ]);
    }

//    public function payment()
//    {
//        return Inertia::render('Profile/PaymentPage', [
//            'auth_user' => Auth::check(),
//            'user' => Auth::user(),
//        ]);
//    }

//    public function accruals()
//    {
//        return Inertia::render('Profile/AccrualsPage', [
//            'auth_user' => Auth::check(),
//        ]);
//    }

    public function connecting()
    {
        return Inertia::render('Profile/ConnectingPage', [
            'auth_user' => Auth::check(),
        ]);
    }

    public function wallets()
    {
        return Inertia::render('Profile/WalletsPage', [
            'auth_user' => Auth::check(),
        ]);
    }

    public function Income()
    {
        return Inertia::render('Profile/IncomePage', [
            'auth_user' => Auth::check(),
        ]);
    }

//    public function ref_page()
//    {
//        return Inertia::render('Profile/RefPage', [
//            'auth_user' => Auth::check(),
//        ]);
//    }

    public function settings()
    {
        return Inertia::render('Profile/SettingsPage', [
            'auth_user' => Auth::check(),
        ]);
    }
}
