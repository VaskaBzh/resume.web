<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    {/*dd(Arr::get(config('inertia.components.public'), $queryable ?? $page));*/
        Inertia::render(
            component: Arr::get(config('inertia.components.public'), $queryable ?? $page),
            props: [
                "token" => csrf_token(),
            ]
        );
    }
}
