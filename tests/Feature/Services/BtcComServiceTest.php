<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Dto\UserData;
use App\Exceptions\BusinessException;
use App\Services\External\BtcComService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class BtcComServiceTest extends TestCase
{

//    /**
//     * @test
//     */
//    public function it_throw_exception_if_subaccount_already_exist()
//    {
//        $service = $this->partialMock(BtcComService::class, function ($mock) {
//            $mock->shouldReceive('call')
//                ->once()
//                ->andReturn(['exist']);
//        });
//
//        $this->expectException(BusinessException::class);
//        $this->expectExceptionMessage(__('actions.sub_account_already_exist'));
//
//        $service->createSub(UserData::fromRequest([
//            'name' => 'MainTest'
//        ]));
//    }

    /**
     * @test
     */
    public function test_create_sub_successfully()
    {
        $userData = UserData::fromRequest([
            'name' => 'MainTest'
        ]);

        $expected = [
            "status" => true,
            "gid" => 6003166,
            "group_name" => "MainTest",
            "created_at" => 1698151086,
            "updated_at" => 1698151086,
        ];

        $mockedResponse = [
            'data' => $expected
        ];

        Http::fake([
            '*' => Http::response($mockedResponse)
        ]);

        $actual = app(BtcComService::class)->createSub($userData);

        $this->assertEqualsCanonicalizing($actual, $expected);
    }

}
