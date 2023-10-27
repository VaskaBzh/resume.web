<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    public User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_logout()
    {
        Sanctum::actingAs($this->user);
        $token = $this->user->createToken('test-token');

        $this->assertAuthenticatedAs($this->user);

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $token->plainTextToken,
        ])
            ->postJson(route('v1.logout'))
            ->assertOk()
            ->assertExactJson(['Logged out']);

        $this->assertDatabaseMissing('personal_access_tokens', ['token' => $token->accessToken->token]);
    }
}
