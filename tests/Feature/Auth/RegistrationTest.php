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
     * @testdox register with valid data and send confirmation notification to user email
     *
     * @param string[] $signUpData
     * @param string|int|bool[] $signUpResponseStructure
     * @return void
     */
    public function successfulRegistration(
        array $signUpData,
        array $signUpResponseStructure,
        array $btcComSubResponse,
    )
    {
        $mockedResponse = [
            'data' => $btcComSubResponse,
        ];

        Http::fake([
           '*' => Http::response($mockedResponse)
        ]);

        Notification::fake();

        $this->postJson('/v1/register', $signUpData)
            ->assertCreated()
            ->assertJsonStructure($signUpResponseStructure);

        $this->assertDatabaseHas('users', [
                'name' => $signUpData['name'],
                'email' => $signUpData['email']
            ]
        );

        $user = User::whereEmail($signUpData['email'])->first();

        $this->assertAuthenticatedAs($user);
        $this->assertDatabaseHas('subs', [
                'sub' => $btcComSubResponse['group_name'],
                'group_id' => $btcComSubResponse['gid']
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
     * @testdox registration with referral code
     */
    public function referralRegistration(
        $signUpData,
        $signUpResponseStructure,
        $btcComSubResponse,
    )
    {
        $user = User::factory()->create();
        app(RoleAndPermissionsSeeder::class)->run();

        $code = app(ReferralService::class)->generateReferralCode($user);
        $user->update(['referral_code' => $code]);
        $mockedResponse = [
            'data' => $btcComSubResponse,
        ];

        $signUpData['referral_code'] = $code;

        Http::fake([
            '*' => Http::response($mockedResponse)
        ]);

        Notification::fake();

        $this->postJson('/v1/register', $signUpData)
            ->assertCreated()
            ->assertJsonStructure($signUpResponseStructure);

        $referral = $user->referrals()->first();

        $this->assertDatabaseHas('users', ['name' => $signUpData['name'], 'email' => $signUpData['email']]);
        $this->assertEquals($referral->email, $signUpData['email']);
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
            [
                'signUpData' => [
                    'name' => 'MainTest',
                    'email' => 'forest@gmail.com',
                    'password' => 'Password12345&',
                    'password_confirmation' => 'Password12345&',
                ],
                'signUpResponseStructure' => [
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
                        'has_referrer_role'
                    ],
                    'token',
                ],
                'btcComSubCreatingResponse' => [
                    "status" => true,
                    "gid" => 6003147,
                    "group_name" => "MainTest",
                    "created_at" => 1698007819,
                    "updated_at" => 1698007819
                ]
            ]
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
            [
                'signUpData' => [
                    'name' => 'MainTest2',
                    'email' => 'test@gmail.com',
                    'password' => 'Password12345&',
                    'password_confirmation' => 'Password12345&',
                ],
                'signUpResponseStructure' => [
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
                        'has_referrer_role'
                    ],
                    'token',
                ],
                'btcComSubCreatingResponse' => [
                    "status" => true,
                    "gid" => 6003147,
                    "group_name" => "MainTest2",
                    "created_at" => 1698007819,
                    "updated_at" => 1698007819
                ]
            ]
        ];
    }
}
