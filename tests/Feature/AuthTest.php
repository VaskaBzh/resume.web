<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PragmaRX\Google2FALaravel\Google2FA;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * @dataProvider authDataProvider
     */
    public function test_login_if_email_not_verified(array $basicAuth)
    {
        $this->postJson('/v1/login', $basicAuth)
            ->assertStatus(Response::HTTP_FORBIDDEN)
            ->assertJsonStructure(['errors' => ['auth']]);
    }

    /**
     * @dataProvider authDataProvider
     */
    public function test_login_if_email_verified(
        array $basicAuth,
        array $loginResponseStructure
    )
    {
        $this->user->markEmailAsVerified();

        $response = $this->postJson('/v1/login', $basicAuth)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure($loginResponseStructure);

        $this->assertAuthenticatedAs($this->user);

        $this->assertNotNull($response['user']['email_verified_at']);
        $this->assertNotEmpty($response['token']);
        $this->assertNotEmpty($response['expired_at']);
    }

    /**
     * @dataProvider authDataProvider
     */
    public function test_login_if_2fa_enable(
        array $basicAuth,
        array $loginResponseStructure,
        array $google2faAuth,

    )
    {
        $this->user->markEmailAsVerified();

        $googleAuth = app(Google2FA::class);
        $secretKey = $googleAuth->generateSecretKey();
        $currentOtp = $googleAuth->getCurrentOtp($secretKey);

        $this->user->update(['google2fa_secret' => $secretKey]);

        $this->postJson('/v1/login', $basicAuth)
            ->assertExactJson($google2faAuth['code_required_error'])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->postJson('/v1/login', array_merge($basicAuth, ['google2fa_code' => 'wrong!']))
            ->assertStatus(Response::HTTP_FORBIDDEN)
            ->assertJson($google2faAuth['wrong_code_error']);

        $response = $this
            ->postJson('/v1/login', array_merge($basicAuth, ['google2fa_code' => $currentOtp]))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure($loginResponseStructure);

        $this->assertAuthenticatedAs($this->user);
        $this->assertNotNull($response['user']['email_verified_at']);
        $this->assertNotEmpty($response['token']);
        $this->assertNotEmpty($response['expired_at']);
    }

    public function authDataProvider(): array
    {
        return [
            [
                'basicAuth' => [
                    'email' => 'forest@gmail.com',
                    'password' => 'password'
                ],
                'loginResponseStructure' => [
                    'user' => [
                        'id',
                        'name',
                        'email',
                        'email_verified_at',
                        'phone',
                        'sms',
                        '2fa',
                        'referral_code',
                        'has_referral_role'
                    ],
                    'token',
                    'expired_at',
                ],
                'google2faAuth' => [
                    'code_required_error' => [
                        "errors" => [
                            "2fa" => ["Pass google2fa_code!"]
                        ]
                    ],
                    'wrong_code_error' => [
                        "errors" => [
                            "2fa" => ["Не верный код"]
                        ]
                    ]
                ],
            ],
        ];
    }
}
