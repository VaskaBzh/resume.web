<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Services\External\BtcComService;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    /**
     * @dataProvider registrationDataProvider
     *
     * @param string[] $signUpData
     * @param string|int|bool[] $signUpResponseStructure
     * @return void
     */
    public function test_registration(
        array $signUpData,
        array $signUpResponseStructure,
        array $btcComSubCreatingResponse,
    )
    {
        $this->partialMock(BtcComService::class,
            static function ($mock) use ($btcComSubCreatingResponse, $signUpData) {
                $mock->shouldReceive('btcHasUser')
                    ->once()
                    ->with([
                        'userData' => 'ddd'
                    ])
                    ->andReturn($btcComSubCreatingResponse);
            });

        $this->partialMock(BtcComService::class,
            static function ($mock) use ($btcComSubCreatingResponse, $signUpData) {
                $mock->shouldReceive('call')
                    ->once()
                    ->with([
                        'segments' => ['groups', 'create'],
                        'method' => 'post',
                        'params' => [
                            'group_name' => $signUpData['name'],
                        ]
                    ])
                    ->andReturn($btcComSubCreatingResponse);
            });


        $this->postJson('/v1/register', $signUpData)
            ->assertOk()
            ->assertJsonStructure($signUpResponseStructure);


        $this->assertDatabaseHas('users', ['name' => 'MainTest666', 'email' => 'test@test.com']);
        $this->assertDatabaseHas('subs', ['sub' => 'MainTest666', 'group_id' => 6003147]);
    }

    public function registrationDataProvider(): array
    {
        return [
            [
                'signUpData' => [
                    'name' => 'MainTest666',
                    'email' => 'test@test.com',
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
                    "group_name" => "MainTest666",
                    "created_at" => 1698007819,
                    "updated_at" => 1698007819
                ]
            ]
        ];
    }
}
