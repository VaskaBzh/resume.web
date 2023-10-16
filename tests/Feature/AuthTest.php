<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{

    private User $user;

    protected function setUp(): void
    {
        $this->user = User::factory()->create();
        dd(User::all());
    }

//    public function test_login()
//    {
//        dd($this->user);
//    }
}
