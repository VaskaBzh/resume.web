<?php

declare(strict_types=1);

namespace Feature\Auth;

use App\Models\User;
use App\Notifications\VerifyEmailNotification;
use App\Services\Internal\ReferralService;
use Database\Seeders\RoleAndPermissionsSeeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider registrationValidDataProvider
     *
     * @testdox register with valid data and send confirmation notification to user email
     *
     * @param  string[]  $credentials
     * @param  string|int|bool[]  $expectedRegistrationResponse
     * @return void
     */
    public function successfulRegistration(
        array $credentials,
        array $expectedRegistrationResponse,
        array $btcComSubResponse,
    ) {
        $mockedResponse = [
            'data' => $btcComSubResponse,
        ];

        Http::fake([
            '*' => Http::response($mockedResponse),
        ]);

        Notification::fake();

        $this->postJson('/v1/register', $credentials)
            ->assertCreated()
            ->assertJsonStructure($expectedRegistrationResponse);

        $this->assertDatabaseHas('users', [
            'name' => $credentials['name'],
            'email' => $credentials['email'],
        ]);

        $user = User::whereEmail($credentials['email'])->first();

        $this->assertAuthenticatedAs($user);
        $this->assertDatabaseHas('subs', [
            'sub' => $btcComSubResponse['group_name'],
            'group_id' => $btcComSubResponse['gid'],
        ]
        );
        Notification::assertSentTo(
            $user,
            VerifyEmailNotification::class
        );
    }

    /**
     * @test
     *
     * @dataProvider referralRegistrationDataProvider
     *
     * @testdox registration with referral code
     */
    public function referralRegistration(
        $credentials,
        $expectedRegistrationResponse,
        $btcComSubResponse,
    ) {
        $user = User::factory()->create();
        app(RoleAndPermissionsSeeder::class)->run();

        $code = app(ReferralService::class)->generateReferralCode($user);

        $user->update(['referral_code' => $code]);
        $mockedResponse = [
            'data' => $btcComSubResponse,
        ];

        $credentials['referral_code'] = $code;

        Http::fake([
            '*' => Http::response($mockedResponse),
        ]);

        Notification::fake();

        $this->postJson('/v1/register', $credentials)
            ->assertCreated()
            ->assertJsonStructure($expectedRegistrationResponse);

        $referral = $user->referrals()->first();

        $this->assertDatabaseHas('users', ['name' => $credentials['name'], 'email' => $credentials['email']]);
        $this->assertEquals($referral->email, $credentials['email']);
        $this->assertEquals($referral->referral_discount, $user->referral_discount);

        Notification::assertSentTo(
            $referral,
            VerifyEmailNotification::class
        );
    }

    /**
     * Pass data to tests
     *
     * @return array[]
     */
    public function registrationValidDataProvider(): array
    {
        return [
            'Common registration' => [
                'credentials' => [
                    'name' => 'MainTest',
                    'email' => 'forest@gmail.com',
                    'password' => 'Password12345&',
                    'password_confirmation' => 'Password12345&',
                ],
                'expectedRegistrationResponse' => [
                    'message',
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
                ],
                'btcComSubCreatingResponse' => [
                    'status' => true,
                    'gid' => 6003147,
                    'group_name' => 'MainTest',
                    'created_at' => 1698007819,
                    'updated_at' => 1698007819,
                ],
            ],
        ];
    }

    /**
     * Pass data to tests
     *
     * @return array[]
     */
    public function referralRegistrationDataProvider(): array
    {
        return [
            'Referral registration' => [
                'credentials' => [
                    'name' => 'MainTest2',
                    'email' => 'test@gmail.com',
                    'password' => 'Password12345&',
                    'password_confirmation' => 'Password12345&',
                ],
                'expectedRegistrationResponse' => [
                    'message',
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
                ],
                'btcComSubCreatingResponse' => [
                    'status' => true,
                    'gid' => 6003147,
                    'group_name' => 'MainTest2',
                    'created_at' => 1698007819,
                    'updated_at' => 1698007819,
                ],
            ],
        ];
    }
}
