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
        return Inertia::render(
            component: Arr::get(config('inertia.components'), $page, 'HomePage'),
            props: [
                'auth_user' => Auth::check(),
                'user' => auth()->user()
            ]
        );
    }
}
