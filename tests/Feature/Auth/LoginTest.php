<?php

declare(strict_types=1);

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

        $this->user = User::first();
    }

    /**
     * @test
     *
     * @dataProvider basicAuthDataProvider
     *
     * @testdox failed login if email not verified
     */
    public function isNotVerified(array $credentials)
    {
        $this->postJson('/v1/login', $credentials)
            ->assertStatus(Response::HTTP_FORBIDDEN)
            ->assertJsonStructure(['errors' => ['messages']]);
    }

    /**
     * @test
     *
     * @testdox success login if email verified
     *
     * @dataProvider basicAuthDataProvider
     *
     * @param  string[]  $credentials
     */
    public function isVerified(
        array $credentials,
        array $expectLoginResponse
    ) {

        $this->user->markEmailAsVerified();
        $this->assertFalse(Auth::check());

        $response = $this->postJson('/v1/login', $credentials)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure($expectLoginResponse);

        $this->assertDatabaseHas('personal_access_tokens', ['name' => $this->user->name]);
        $this->assertAuthenticatedAs($this->user);

        $this->assertNotNull($response['user']['email_verified_at']);
        $this->assertNotEmpty($response['token']);
        $this->assertNotEmpty($response['expired_at']);
    }

    /**
     * @test
     *
     * @testdox failed login if 2fa enabled and pass wrong code
     *
     * @dataProvider twoFacAuthDataProvider
     */
    public function twoFaWongCode(
        array $credentials,
        array $expectErrors
    ) {
        $this->user->markEmailAsVerified();

        $this->enable2fa();

        $this->postJson('/v1/login', array_merge($credentials, ['google2fa_code' => '666666']))
            ->assertStatus(Response::HTTP_FORBIDDEN)
            ->assertJson($expectErrors['wrong_code_error']);

        $this->assertFalse(Auth::check());
    }

    /**
     * @test
     *
     * @testdox it show code require error when 2fa enabled
     *
     * @dataProvider twoFacAuthDataProvider
     */
    public function showTwoFaRequireError(
        array $credentials,
        array $expectErrors,
    ) {
        $this->user->markEmailAsVerified();

        $this->enable2fa();

        $this->postJson('/v1/login', $credentials)
            ->assertExactJson($expectErrors['code_required_error'])
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertFalse(Auth::check());
    }

    /**
     * @test
     *
     * @testdox login with 2fa
     *
     * @dataProvider twoFacAuthDataProvider
     */
    public function twoFaLogin(
        array $credentials,
        array $expectErrors,
        array $expectLoginResponse,
    ) {
        $this->user->markEmailAsVerified();

        $currentOtp = $this->enable2fa();

        $this->assertFalse(Auth::check());

        $response = $this
            ->postJson('/v1/login', array_merge($credentials, ['google2fa_code' => $currentOtp]))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure($expectLoginResponse);

        $this->assertDatabaseHas('personal_access_tokens', ['name' => $this->user->name]);
        $this->assertAuthenticatedAs($this->user);
        $this->assertNotNull($response['user']['email_verified_at']);
        $this->assertNotEmpty($response['token']);
        $this->assertNotEmpty($response['expired_at']);
    }

    /**
     * Enable 2fa for tests
     *
     * @throws IncompatibleWithGoogleAuthenticatorException
     * @throws InvalidCharactersException
     * @throws SecretKeyTooShortException
     */
    public function enable2fa(): string
    {
        $googleAuth = app(Google2FA::class);

        $this->user->update([
            'google2fa_secret' => $secretKey = $googleAuth->generateSecretKey(),
        ]);

        return $googleAuth->getCurrentOtp($secretKey);
    }

    public function basicAuthDataProvider(): array
    {
        return [
            'Basic auth' => [
                'credentials' => [
                    'email' => 'first@gmail.com',
                    'password' => '123',
                ],
                'expectLoginResponse' => [
                    'user' => [
                        'id',
                        'name',
                        'email',
                        'email_verified_at',
                        'phone',
                        'sms',
                        '2fa',
                        'referral_url',
                        'has_referrer_role',
                    ],
                    'token',
                    'expired_at',
                ],
            ],
        ];
    }

    /**
     * @return array[]
     */
    public function twoFacAuthDataProvider(): array
    {
        return [
            'Google auth' => [
                'credentials' => [
                    'email' => 'first@gmail.com',
                    'password' => '123',
                ],
                'expectedErrors' => [
                    'code_required_error' => [
                        'errors' => [
                            'messages' => ['Pass 2fa code!'],
                        ],
                    ],
                    'wrong_code_error' => [
                        'errors' => [
                            'messages' => ['Wrong code'],
                        ],
                    ],
                    'validation_error' => [
                        'message' => 'The google2fa code must be a number. (and 1 more error)',
                        'errors' => [
                            'google2fa_code' => [
                                'The google2fa code must be a number.',
                                'The google2fa code must be 6 digits.',
                            ],
                        ],
                    ],
                ],
                'expectLoginResponse' => [
                    'user' => [
                        'id',
                        'name',
                        'email',
                        'email_verified_at',
                        'phone',
                        'sms',
                        '2fa',
                        'referral_url',
                        'has_referrer_role',
                    ],
                    'token',
                    'expired_at',
                ],
            ],
        ];
    }
}
