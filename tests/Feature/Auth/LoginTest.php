<?php

namespace Feature\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Exceptions\IncompatibleWithGoogleAuthenticatorException;
use PragmaRX\Google2FA\Exceptions\InvalidCharactersException;
use PragmaRX\Google2FA\Exceptions\SecretKeyTooShortException;
use PragmaRX\Google2FALaravel\Google2FA;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class LoginTest extends TestCase
{
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
            ->assertJsonStructure(['errors' => ['messages']]);
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

        $this->assertFalse(Auth::check());

        $response = $this->postJson('/v1/login', $basicAuth)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure($loginResponseStructure);

        $this->assertDatabaseHas('personal_access_tokens', ['name' => $this->user->name]);
        $this->assertAuthenticatedAs($this->user);

        $this->assertNotNull($response['user']['email_verified_at']);
        $this->assertNotEmpty($response['token']);
        $this->assertNotEmpty($response['expired_at']);
    }

    /**
     * @dataProvider authDataProvider
     */
    public function test_login_if_2fa_enabled_with_wrong_code(
        array $basicAuth,
        array $loginResponseStructure,
        array $google2faAuth
    )
    {
        $this->user->markEmailAsVerified();

        $this->enable2fa();

        $this->postJson('/v1/login', array_merge($basicAuth, ['google2fa_code' => '666666']))
            ->assertStatus(Response::HTTP_FORBIDDEN)
            ->assertJson($google2faAuth['wrong_code_error']);

        $this->assertFalse(Auth::check());
    }

    /**
     * @dataProvider authDataProvider
     */
    public function test_login_if_2fa_enabled_notification(
        array $basicAuth,
        array $loginResponseStructure,
        array $google2faAuth
    )
    {
        $this->user->markEmailAsVerified();

        $this->enable2fa();

        $this->postJson('/v1/login', $basicAuth)
            ->assertExactJson($google2faAuth['code_required_error'])
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertFalse(Auth::check());
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

        $currentOtp = $this->enable2fa();

        $this->assertFalse(Auth::check());

        $response = $this
            ->postJson('/v1/login', array_merge($basicAuth, ['google2fa_code' => $currentOtp]))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure($loginResponseStructure);

        $this->assertDatabaseHas('personal_access_tokens', ['name' => $this->user->name]);
        $this->assertAuthenticatedAs($this->user);
        $this->assertNotNull($response['user']['email_verified_at']);
        $this->assertNotEmpty($response['token']);
        $this->assertNotEmpty($response['expired_at']);
    }

    /**
     *
     * @return string
     * @throws IncompatibleWithGoogleAuthenticatorException
     * @throws InvalidCharactersException
     * @throws SecretKeyTooShortException
     */
    public function enable2fa(): string
    {
        $googleAuth = app(Google2FA::class);

        $this->user->update([
            'google2fa_secret' => $secretKey = $googleAuth->generateSecretKey()
        ]);

        return $googleAuth->getCurrentOtp($secretKey);
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
                        'has_referrer_role'
                    ],
                    'token',
                    'expired_at',
                ],
                'google2faAuth' => [
                    'code_required_error' => [
                        "errors" => [
                            "messages" => ["Pass 2fa code!"]
                        ]
                    ],
                    'wrong_code_error' => [
                        'errors' => [
                            'messages' => ['Wrong code']
                        ]
                    ],
                    'validation_error' => [
                        'message' => 'The google2fa code must be a number. (and 1 more error)',
                        'errors' => [
                            'google2fa_code' => [
                                'The google2fa code must be a number.',
                                'The google2fa code must be 6 digits.'
                            ]
                        ],

                    ]
                ],
            ],
        ];
    }
}
