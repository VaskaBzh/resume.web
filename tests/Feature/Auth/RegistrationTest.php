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
            config('api.btc.uri') . '/groups/create' => Http::response($mockedResponse)
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

//    /**
//     * @test
//     *
//     * @dataProvider referralRegistrationDataProvider
//     */
//    public function it_register_with_referral_code(
//        $signUpData,
//        $signUpResponseStructure,
//        $btcComSubResponse,
//    )
//    {
//        User::factory()->create();
//        $sub = Sub::factory()->create();
//
//        $mockedResponse = [
//            'data' => $btcComSubResponse,
//        ];
//
//        $signUpData['referral_code'] = app(ReferralService::class)->generateReferralCode($sub->group_id);
//
//        Http::fake([
//            config('api.btc.uri') . '/groups/create' => Http::response($mockedResponse)
//        ]);
//
//        Notification::fake();
//
//        $mockedResponse = [
//            'data' => $btcComSubResponse,
//        ];
//
//
//        $this->postJson('/v1/register', $signUpData)
//            ->assertCreated()
//            ->assertJsonStructure($signUpResponseStructure);
//    }

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
