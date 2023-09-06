<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return Inertia::render(
            component:'HomePage',
            props: ['user' => auth()->user()]
        );
    }

    public function show(string $page)
    {
        return Inertia::render(
            component: Arr::get(config('inertia.components.public'), $page, 'ErrorPage'),
            props: [
                'user' => auth()->user(),
                "token" => csrf_token(),
            ]
        );
    }
}
