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

    /**
     * @test
     *
     * @testdox generate 2fa qr code and secret key
     * @return void
     */
    public function generateTwoFaQrCode()
    {
        $this->getJson(route('v1.2fa.qrcode', $this->user))
            ->assertOk()
            ->assertJsonStructure([
                'qrCode', 'secret'
            ]);
    }

    /**
     * @test
     *
     * @testdox Enabling 2fa
     * @return void
     */
    public function TwoFaEnabling()
    {
        $googleAuth = app(Google2FA::class);
        $secretKey = $googleAuth->generateSecretKey();

        $this->actingAs($this->user)->putJson(route('v1.2fa.enable', $this->user), [
            'secret' => $secretKey,
            'code' => $googleAuth->getCurrentOtp($secretKey),
        ])
            ->assertOk()
            ->assertJsonStructure(['message']);

        $this->assertDatabaseHas('users', ['id' => $this->user->id, 'google2fa_secret' => $secretKey]);
    }

    /**
     * @test
     *
     * @testdox 2fa disabling
     * @return void
     */
    public function twoFaDisabling()
    {
        $googleAuth = app(Google2FA::class);
        $secretKey = $googleAuth->generateSecretKey();

        $this->user->update(['google2fa_secret' => $secretKey]);
        $this
            ->actingAs($this->user)->putJson(route('v1.2fa.disable', $this->user), [
                'code' => $googleAuth->getCurrentOtp($secretKey)
            ])
            ->assertOk()
            ->assertJson([
                'status' => true,
                'message' => 'Two factor is disabled',
            ]);

        $this->assertDatabaseHas('users', ['id' => $this->user->id, 'google2fa_secret' => null]);
    }
}
