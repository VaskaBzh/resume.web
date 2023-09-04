<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PageController extends Controller
{
    public function index()
    {
        return Inertia::render(
            component: Arr::get(config('inertia.components'), 'home', 'HomePage')
        );
    }

    public function show(Request $request, string $page)
    {
        Inertia::render(
            component: Arr::get(config('inertia.components'), $queryable ?? $page, 'HomePage'),
            props: [
                "token" => csrf_token(),
            ]
        );
    }
}
