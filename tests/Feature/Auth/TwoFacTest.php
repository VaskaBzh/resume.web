<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use PragmaRX\Google2FALaravel\Google2FA;
use Tests\TestCase;

class TwoFacTest extends TestCase
{
    public User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);
    }

    public function test_generate_2fa_qrCode_and_secret_key()
    {
        $this->getJson(route('v1.2fa.qrcode', $this->user))
            ->assertOk()
            ->assertJsonStructure([
                'qrCode', 'secret'
            ]);
    }

    public function test_2fa_enable()
    {
        $googleAuth = app(Google2FA::class);
        $secretKey = $googleAuth->generateSecretKey();

        $this->putJson(route('v1.2fa.enable', $this->user), [
            'secret' => $secretKey,
            'code' => $googleAuth->getCurrentOtp($secretKey),
        ])
            ->assertOk()
            ->assertJsonStructure(['message']);

        $this->assertDatabaseHas('users', ['id' => $this->user->id, 'google2fa_secret' => $secretKey]);
    }

    public function test_2fa_disable()
    {
        $googleAuth = app(Google2FA::class);
        $secretKey = $googleAuth->generateSecretKey();

        $this->user->update(['google2fa_secret' => $secretKey]);
        $this
            ->putJson(route('v1.2fa.disable', $this->user))
            ->assertOk()
            ->assertJson([
                'status' => true,
                'message' => 'Two factor is disabled',
            ]);

        $this->assertDatabaseHas('users', ['id' => $this->user->id, 'google2fa_secret' => null]);
    }
}
