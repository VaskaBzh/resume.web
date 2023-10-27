<?php

declare(strict_types=1);

namespace Feature\Auth;

use App\Dto\UserData;
use App\Models\User;
use App\Notifications\VerifyEmailNotification;
use App\Services\External\BtcComService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class RegistrationTest extends TestCase
{

    /**
     * @dataProvider registrationValidDataProvider
     *
     * @param string[] $signUpData
     * @param string|int|bool[] $signUpResponseStructure
     * @return void
     */
    public function test_registration_if_valid_data(
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
}
