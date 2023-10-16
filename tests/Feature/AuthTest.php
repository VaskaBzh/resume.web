<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function test_login()
    {
        dd(User::all());
    }
}
