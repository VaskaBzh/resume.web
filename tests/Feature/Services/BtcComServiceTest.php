<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Dto\UserData;
use App\Exceptions\BusinessException;
use App\Models\MinerStat;
use App\Models\Sub;
use App\Models\User;
use App\Models\Worker;
use App\Services\External\BtcComService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class BtcComServiceTest extends TestCase
{
    private readonly User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        MinerStat::factory()->create();
        Worker::factory()->create();
    }

    /**
     * @test
     *
     * @dataProvider createRemoteSubDataProvider
     */
    public function it_throw_exception_if_remote_subaccount_already_exist(UserData $userData)
    {
        Http::fake([
            config('api.btc.uri') . '/groups/create' => Http::response(['data' => ['exist']])
        ]);

        $this->expectException(BusinessException::class);
        $this->expectExceptionMessage(__('actions.sub_account_already_exist'));

        app(BtcComService::class)->createSub($userData);
    }

    /**
     * @test
     *
     * @dataProvider createRemoteSubDataProvider
     */
    public function it_create_remote_ub_successfully(UserData $userData, array $expected)
    {

        $mockedResponse = [
            'data' => $expected
        ];

        Http::fake([
            config('api.btc.uri') . '/groups/create' => Http::response($mockedResponse)
        ]);

        $actual = app(BtcComService::class)->createSub($userData);

        $this->assertEqualsCanonicalizing($actual, $expected);
    }

    /**
     * @test
     *
     * @dataProvider transformSubDataProvider
     */
    public function it_transform_sub_correctly(
        Collection $localSub,
        array $btcComSubResponse
    )
    {
        $mockedResponse = [
            'data' => $btcComSubResponse
        ];

        Http::fake([
            '*' => Http::response($mockedResponse)
        ]);

        $actual = app(BtcComService::class)->transformSubCollection($localSub);

        dd($actual);

    }

    public function createRemoteSubDataProvider(): array
    {
        return [
            [
                'userData' => UserData::fromRequest([
                    'name' => 'MainTest'
                ]),
                'expected' => [
                    "status" => true,
                    "gid" => 6003166,
                    "group_name" => "MainTest",
                    "created_at" => 1698151086,
                    "updated_at" => 1698151086,
                ],
            ]
        ];
    }

    public function transformSubDataProvider(): array
    {
        return [
            [
                'localSubs' => collect([
                    new Sub([
                        'group_id' => 666666,
                        'sub' => 'sub2',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'percent' => 3.5,
                        'pending_amount' => 0,
                        'total_amount' => 0,
                        'user_id' => 1,
                    ]),
                    new Sub([
                        'group_id' => 777777,
                        'sub' => 'sub1',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'percent' => 3.5,
                        'pending_amount' => 0,
                        'total_amount' => 0,

                        'user_id' => 1,
                    ])
                ]),
                'btcComSubResponse' => [
                    'list' => [
                        ['gid' => -1],
                        ['gid' => 0],
                        [
                            "gid" => 666666,
                            "name" => "MainTest",
                            "created_at" => 1681501367,
                            "updated_at" => 1681501367,
                            "workers_active" => 2,
                            "workers_inactive" => 0,
                            "workers_dead" => 3,
                            "shares_1m" => 105,
                            "shares_5m" => "75.060",
                            "shares_15m" => "75.060",
                            "reject_percent" => "0.0000",
                            "workers_total" => 1,
                            "sort_id" => "6001912",
                            "shares_unit" => "T",
                            "shares_1h" => 0,
                            "shares_1d" => 200,
                            "shares_1m_pure" => "75061139114121",
                            "shares_5m_pure" => "75061139114121",
                            "shares_15m_pure" => "75061139114121",
                            "shares_1h_pure" => 0,
                            "shares_1d_pure" => 0,
                        ],
                        [
                            "workers_active" => 0,
                            "workers_inactive" => 0,
                            "workers_dead" => 0,
                            "shares_1m" => "0.00",
                            "shares_5m" => "0.00",
                            "shares_15m" => "0",
                            "workers_total" => 0,
                            "reject_percent" => "0.00",
                            "shares_unit" => "T",
                            "gid" => 777777,
                            "sort_id" => 6002031,
                            "name" => "MiltonFrost",
                            "created_at" => 1682499803,
                            "updated_at" => 1682499803,
                        ],
                        [
                            "workers_active" => 0,
                            "workers_inactive" => 0,
                            "workers_dead" => 0,
                            "shares_1m" => "0.00",
                            "shares_5m" => "0.00",
                            "shares_15m" => "0",
                            "workers_total" => 0,
                            "reject_percent" => "0.00",
                            "shares_unit" => "T",
                            "gid" => 6002059,
                            "sort_id" => 6002059,
                            "name" => "MontereyMining77",
                            "created_at" => 1682673065,
                            "updated_at" => 1682673065,
                        ],
                    ]
                ]
            ]
        ];
    }
}
