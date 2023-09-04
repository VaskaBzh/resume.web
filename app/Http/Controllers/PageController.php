<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Inertia\Inertia;

class PageController extends Controller
{

    public function index()
    {
        return Inertia::render(
            component: Arr::get(config('inertia.components.public'), 'home', 'HomePage')
        );
    }

    public function show(Request $request, string $page)
    {
        Inertia::render(
            component: Arr::get(config('inertia.components.public'), $page),
            props: [
                'user' => auth()->user(),
                "token" => csrf_token(),
            ]
        );
    }
}
