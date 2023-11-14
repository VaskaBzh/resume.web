<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    /**
     * @test
     *
     * @testdox logout
     *
     * @return void
     */
    public function logout()
    {
        $user = User::first();
        Sanctum::actingAs($user);
        $token = $user->createToken('test-token');

        $this->assertAuthenticatedAs($user);

        $this->withHeaders([
            'Authorization' => 'Bearer '.$token->plainTextToken,
        ])
            ->postJson(route('v1.logout'))
            ->assertOk()
            ->assertExactJson(['Logged out']);

        $this->assertDatabaseMissing('personal_access_tokens', ['token' => $token->accessToken->token]);
    }
}
