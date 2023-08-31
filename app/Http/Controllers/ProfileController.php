<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function __invoke(string $page)
    {
        return Inertia::render(
            component: implode('/', ['Profile', ucfirst(Str::camel($page) . 'Page')]),
            props: [
                'auth_user' => Auth::check(),
                'user' => auth()->user()
            ]
        );
    }
}
