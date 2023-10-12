<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function __invoke(): UserResource
    {
        return new UserResource(auth()->user());
    }
}
