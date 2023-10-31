<?php

declare(strict_types=1);

namespace Feature\Auth;

use App\Dto\UserData;
use App\Models\Sub;
use App\Models\User;
use App\Notifications\VerifyEmailNotification;
use App\Services\External\BtcComService;
use App\Services\Internal\ReferralService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider registrationValidDataProvider
     *
     * @param string[] $signUpData
     * @param string|int|bool[] $signUpResponseStructure
     * @return void
     */
    public function it_register_if_valid_data(
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
     */
    public function it_register_with_referral_code(
        $signUpData,
        $signUpResponseStructure,
        $btcComSubResponse,
    )
    {
        $user = User::factory()->create();
        Sub::factory()->create();

        $code = app(ReferralService::class)->generateReferralCode(666666);
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

        $this->assertDatabaseHas('users', ['name' => $signUpData['name'], 'email' => $signUpData['email']]);
        $referral = User::whereEmail($signUpData['email'])->first();
        $this->assertDatabaseHas('referrals', ['user_id' => $referral->id, 'group_id' => 666666]);

        Notification::assertSentTo(
            $referral,
            VerifyEmailNotification::class
        );
    }

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
                        'referral_code',
                        'has_referral_role'
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
                        'referral_code',
                        'has_referral_role'
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
