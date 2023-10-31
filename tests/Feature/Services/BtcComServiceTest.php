<?php
//
//declare(strict_types=1);
//
//namespace Tests\Feature\Services;
//
//use App\Dto\WorkerData;
//use App\Dto\WorkerHashRateData;
//use App\Exceptions\BusinessException;
//use App\Models\MinerStat;
//use App\Models\Sub;
//use App\Models\User;
//use App\Services\External\BtcComService;
//use DB;
//use Illuminate\Support\Carbon;
//use Illuminate\Support\Collection;
//use Illuminate\Support\Facades\Http;
//use Tests\TestCase;
//
//class BtcComServiceTest extends TestCase
//{
//    private readonly User $user;
//
//    protected function setUp(): void
//    {
//        parent::setUp();
//
//        $this->user = User::factory()->create();
//        MinerStat::factory()->create();
//    }
//
//    /**
//     * @test
//     *
//     * @dataProvider createRemoteSubDataProvider
//     */
//    public function it_throw_exception_if_remote_subaccount_already_exist()
//    {
//        $this->makeFakeRequestToBtcCom(['data' => ['exist']]);
//
//        $this->expectException(BusinessException::class);
//        $this->expectExceptionMessage(__('actions.sub_account_already_exist'));
//
//        app(BtcComService::class)->createSub($this->user->id, 'MainTest');
//
//        $this->assertDatabaseMissing('subs', ['user_id' => $this->user->id, 'sub' => $this->user->name]);
//    }
//
//    /**
//     * @test
//     *
//     * @dataProvider createRemoteSubDataProvider
//     */
//    public function it_create_remote_sub_successfully(array $btcComSubResponse)
//    {
//        $this->makeFakeRequestToBtcCom(['data' => $btcComSubResponse]);
//
//        app(BtcComService::class)->createSub($this->user->id, 'MainTest');
//
//        $this->assertDatabaseHas('subs', [
//                'user_id' => $this->user->id,
//                'group_id' => $btcComSubResponse['gid'],
//                'sub' => $btcComSubResponse['group_name']
//            ]
//        );
//    }
//
//    public function it_create_local_sub_successfully()
//    {
//
//    }
//
//    /**
//     * @test
//     *
//     * @dataProvider transformSubDataProvider
//     */
//    public function it_transform_sub_without_workers_correctly(
//        Collection $localSubs,
//        array      $btcComSubResponse,
//        array      $expectedSubCollection,
//    )
//    {
//        $this->makeFakeRequestToBtcCom(['data' => $btcComSubResponse]);
//
//        $actualSubCollection = app(BtcComService::class)->transformSubCollection($localSubs);
//
//        $this->assertTrue($actualSubCollection instanceof Collection);
//        $this->assertEquals(count($expectedSubCollection), $actualSubCollection->count());
//
//        array_map(function ($actualSub, $expectedSub) {
//            foreach ($actualSub as $property => $value) {
//                $this->assertEquals($expectedSub[$property], $value, $property);
//            }
//        }, $actualSubCollection->toArray(), $expectedSubCollection);
//    }
//
//    /**
//     * @test
//     *
//     */
//    public function it_transform_remote_grouped_empty_worker_list()
//    {
//        $actual = app(BtcComService::class)->transformRemoteGroupedWorkers(collect());
//
//        $this->assertTrue($actual instanceof Collection);
//        $this->assertTrue($actual->isEmpty());
//    }
//
//    /**
//     * @test
//     *
//     * @dataProvider groupedWorkerListDataProvider
//     */
//    public function it_transform_remote_grouped_worker_list_correctly(
//        array $btcComWorkerListResponse,
//        array $expectedTransform,
//    )
//    {
//        $actual = app(BtcComService::class)
//            ->transformRemoteGroupedWorkers(collect($btcComWorkerListResponse['data']));
//
//        $this->assertTrue($actual instanceof Collection);
//
//        array_map(function (
//            WorkerData $actualWorkerData,
//            WorkerData $expectedWorkerData
//        ) {
//
//            $this->assertTrue(filled($actualWorkerData->poolData));
//
//            foreach ($actualWorkerData as $property => $value) {
//                if (is_array($value)) {
//                    continue;
//                }
//
//                $this->assertEquals($expectedWorkerData->$property, $value, $property);
//            }
//        }, $actual->toArray(), $expectedTransform);
//    }
//
//    /**
//     * @test
//     */
//    public function it_return_empty_collection_if_remote_worker_list_is_empty()
//    {
//        $actual = app(BtcComService::class)->transformRemoteUngroupedWorkers(Sub::all(), collect());
//
//        $this->assertTrue($actual instanceof Collection);
//        $this->assertTrue($actual->isEmpty());
//    }
//
//
//    /**
//     * @test
//     *
//     * @dataProvider ungroupedWorkerListDataProvider
//     */
//    public function it_return_empty_collection_if_not_matched_by_sub_name(array $ungroupedRemoteWorkerList)
//    {
//        $actual = app(BtcComService::class)
//            ->transformRemoteUngroupedWorkers(Sub::all(), collect($ungroupedRemoteWorkerList['data']));
//
//        $this->assertTrue($actual instanceof Collection);
//        $this->assertTrue($actual->isEmpty());
//    }
//
//    /**
//     * @test
//     *
//     * @dataProvider ungroupedWorkerListDataProvider
//     */
//    public function it_transform_remote_ungrouped_worker_list_correctly(
//        array $ungroupedRemoteWorkerList,
//        array $expectedTransform,
//    )
//    {
//        DB::table('subs')->insert([
//            [
//                'user_id' => $this->user->id,
//                'sub' => 'Ramaz',
//                'group_id' => 666666,
//            ],
//            [
//                'user_id' => $this->user->id,
//                'sub' => 'evgen789',
//                'group_id' => 6003108,
//            ],
//        ]);
//
//        $actual = app(BtcComService::class)
//            ->transformRemoteUngroupedWorkers(Sub::all(), collect($ungroupedRemoteWorkerList['data']));
//
//        $this->assertTrue($actual instanceof Collection);
//
//        array_map(function ($actual, $expected) {
//            $this->assertTrue(filled($actual['worker_data']));
//            $this->assertTrue(filled($actual['worker_hash_rate']));
//            $this->assertTrue(filled($actual['worker_data']->poolData));
//
//            $this->assertTrue($actual['worker_data'] instanceof $expected['worker_data']);
//
//            foreach ($actual as $property => $value) {
//                if (is_array($property)) {
//                    continue;
//                }
//
//                $this->assertEquals($expected[$property], $value);
//            }
//
//        }, $actual->toArray(), $expectedTransform);
//    }
//
//    /*                Data providers                    */
//
//    public function createRemoteSubDataProvider(): array
//    {
//        return [
//            [
//                'btcComSubResponse' => [
//                    "status" => true,
//                    "gid" => 6003166,
//                    "group_name" => "MainTest",
//                    "created_at" => 1698151086,
//                    "updated_at" => 1698151086,
//                ],
//            ]
//        ];
//    }
//
//    public function createLocalSubDataProvider(): array
//    {
//        return [
//            [
//                'expected' => [
//                    "status" => true,
//                    "gid" => 6003166,
//                    "group_name" => "MainTest",
//                    "created_at" => 1698151086,
//                    "updated_at" => 1698151086,
//                ],
//            ]
//        ];
//    }
//
//    public function transformSubDataProvider(): array
//    {
//        return [
//            [
//                'localSubs' => collect([
//                    new Sub([
//                        'group_id' => 666666,
//                        'sub' => 'MainTest',
//                        'created_at' => Carbon::now(),
//                        'updated_at' => Carbon::now(),
//                        'percent' => 3.5,
//                        'pending_amount' => 0,
//                        'total_amount' => 0,
//                        'user_id' => 1,
//                    ]),
//                    new Sub([
//                        'group_id' => 777777,
//                        'sub' => 'MainTest2',
//                        'created_at' => Carbon::now(),
//                        'updated_at' => Carbon::now(),
//                        'percent' => 3.5,
//                        'pending_amount' => 0,
//                        'total_amount' => 0,
//
//                        'user_id' => 1,
//                    ])
//                ]),
//                'btcComSubResponse' => [
//                    'list' => [
//                        ['gid' => -1],
//                        ['gid' => 0],
//                        [
//                            "gid" => 666666,
//                            "name" => "MainTest",
//                            "created_at" => 1681501367,
//                            "updated_at" => 1681501367,
//                            "workers_active" => 0,
//                            "workers_inactive" => 0,
//                            "workers_dead" => 3,
//                            "shares_1m" => 105,
//                            "shares_5m" => "75.060",
//                            "shares_15m" => "75.060",
//                            "reject_percent" => "0.0000",
//                            "workers_total" => 1,
//                            "sort_id" => "6001912",
//                            "shares_unit" => "T",
//                            "shares_1h" => 0,
//                            "shares_1d" => 0,
//                            "shares_1m_pure" => "75061139114121",
//                            "shares_5m_pure" => "75061139114121",
//                            "shares_15m_pure" => "75061139114121",
//                            "shares_1h_pure" => 0,
//                            "shares_1d_pure" => 0,
//                        ],
//                        [
//                            "workers_active" => 0,
//                            "workers_inactive" => 0,
//                            "workers_dead" => 3,
//                            "shares_1m" => 108,
//                            "shares_5m" => "0.00",
//                            "shares_15m" => "0",
//                            "workers_total" => 0,
//                            "reject_percent" => "0.00",
//                            "shares_unit" => "T",
//                            "gid" => 777777,
//                            "sort_id" => 6002031,
//                            "name" => "MainTest2",
//                            "created_at" => 1682499803,
//                            "updated_at" => 1682499803,
//                        ],
//                        [
//                            "workers_active" => 0,
//                            "workers_inactive" => 0,
//                            "workers_dead" => 0,
//                            "shares_1m" => "0.00",
//                            "shares_5m" => "0.00",
//                            "shares_15m" => "0",
//                            "workers_total" => 0,
//                            "reject_percent" => "0.00",
//                            "shares_unit" => "T",
//                            "gid" => 6002059,
//                            "sort_id" => 6002059,
//                            "name" => "MontereyMining77",
//                            "created_at" => 1682673065,
//                            "updated_at" => 1682673065,
//                        ],
//                    ]
//                ],
//                'expectedSubCollection' => [
//                    [
//                        "sub" => "MainTest",
//                        "user_id" => 1,
//                        "pending_amount" => 0.0,
//                        "group_id" => 666666,
//                        "workers_count_active" => 0,
//                        "workers_count_in_active" => 0,
//                        "workers_count_unstable" => 3,
//                        "hash_per_min" => 105,
//                        "hash_per_day" => 0.0,
//                        "today_forecast" => "0.00000000",
//                        "reject_percent" => 0.0,
//                        "unit" => "T",
//                        "total_payout" => 0,
//                        "yesterday_amount" => 0.0,
//                    ],
//                    [
//                        "sub" => "MainTest2",
//                        "user_id" => 1,
//                        "pending_amount" => 0.0,
//                        "group_id" => 777777,
//                        "workers_count_active" => 0,
//                        "workers_count_in_active" => 0,
//                        "workers_count_unstable" => 3,
//                        "hash_per_min" => 108,
//                        "hash_per_day" => 0.0,
//                        "today_forecast" => "0.00000000",
//                        "reject_percent" => 0.0,
//                        "unit" => "T",
//                        "total_payout" => 0,
//                        "yesterday_amount" => 0.0,
//                    ]
//                ]
//            ]
//        ];
//    }
//
//    public function groupedWorkerListDataProvider(): array
//    {
//        return [
//            [
//                'btcComWorkerListResponse' => [
//                    'data' => [
//                        [
//                            "gid" => 6002482,
//                            "group_name" => "Ramaz",
//                            "worker_id" => "6140576275788688963",
//                            "worker_name" => "Ramaz.S19x10x110x0x66",
//                            "is_top" => false,
//                            "shares_1m" => "108.800",
//                            "shares_5m" => "108.800",
//                            "shares_15m" => "108.800",
//                            "accept_count" => "-",
//                            "last_share_time" => 1698327976,
//                            "last_share_ip" => "164.90.191.249",
//                            "reject_percent" => "0.0000",
//                            "first_share_time" => 1688726898,
//                            "miner_agent" => "",
//                            "shares_unit" => "T",
//                            "status" => "ACTIVE",
//                            "shares_1h" => 0,
//                            "shares_1d" => "121.31",
//                            "shares_1m_pure" => "108838623082359",
//                            "shares_5m_pure" => "108838651715475",
//                            "shares_15m_pure" => "108838651715475",
//                            "shares_1h_pure" => 0,
//                            "shares_1d_pure" => 0,
//                            "shares_1d_unit" => "T",
//                            "reject_percent_1d" => "0.0000",
//                        ],
//                        [
//                            "gid" => 6003108,
//                            "group_name" => "evgen789",
//                            "worker_id" => "-3844127170179888225",
//                            "worker_name" => "evgen789.10x102x0x72",
//                            "is_top" => false,
//                            "shares_1m" => "123.800",
//                            "shares_5m" => "123.800",
//                            "shares_15m" => "123.800",
//                            "accept_count" => "-",
//                            "last_share_time" => 1698327976,
//                            "last_share_ip" => "164.90.191.249",
//                            "reject_percent" => "0.0000",
//                            "first_share_time" => 1697533935,
//                            "miner_agent" => "",
//                            "shares_unit" => "T",
//                            "status" => "INACTIVE",
//                            "shares_1h" => 0,
//                            "shares_1d" => "106.52",
//                            "shares_1m_pure" => "123850822272068",
//                            "shares_5m_pure" => "123850879538299",
//                            "shares_15m_pure" => "123850879538299",
//                            "shares_1h_pure" => 0,
//                            "shares_1d_pure" => 0,
//                            "shares_1d_unit" => "T",
//                            "reject_percent_1d" => "0.0000",
//                        ]
//                    ]
//                ],
//                'expectedTransform' => [
//                    WorkerData::fromRequest([
//                        'group_id' => 6002482,
//                        'worker_id' => 6140576275788688963,
//                        'name' => 'Ramaz.S19x10x110x0x66',
//                        'approximate_hash_rate' => 121.31,
//                        'status' => "ACTIVE",
//                        'unit' => "T",
//                        'pool_data' => [
//                            [
//                                "gid" => 6002482,
//                                "group_name" => "Ramaz",
//                                "worker_id" => "6140576275788688963",
//                                "worker_name" => "Ramaz.S19x10x110x0x66",
//                                "is_top" => false,
//                                "shares_1m" => "108.800",
//                                "shares_5m" => "108.800",
//                                "shares_15m" => "108.800",
//                                "accept_count" => "-",
//                                "last_share_time" => 1698327976,
//                                "last_share_ip" => "164.90.191.249",
//                                "reject_percent" => "0.0000",
//                                "first_share_time" => 1688726898,
//                                "miner_agent" => "",
//                                "shares_unit" => "T",
//                                "status" => "ACTIVE",
//                                "shares_1h" => 0,
//                                "shares_1d" => "121.31",
//                                "shares_1m_pure" => "108838623082359",
//                                "shares_5m_pure" => "108838651715475",
//                                "shares_15m_pure" => "108838651715475",
//                                "shares_1h_pure" => 0,
//                                "shares_1d_pure" => 0,
//                                "shares_1d_unit" => "T",
//                                "reject_percent_1d" => "0.0000",
//                            ]
//                        ]
//                    ]),
//                    WorkerData::fromRequest([
//                        'group_id' => 6003108,
//                        'worker_id' => -3844127170179888225,
//                        'name' => 'evgen789.10x102x0x72',
//                        'approximate_hash_rate' => 106.52,
//                        'status' => "INACTIVE",
//                        'unit' => "T",
//                        'pool_data' => [
//                            [
//                                "gid" => 6003108,
//                                "group_name" => "evgen789",
//                                "worker_id" => "-3844127170179888225",
//                                "worker_name" => "evgen789.10x102x0x72",
//                                "is_top" => false,
//                                "shares_1m" => "123.800",
//                                "shares_5m" => "123.800",
//                                "shares_15m" => "123.800",
//                                "accept_count" => "-",
//                                "last_share_time" => 1698327976,
//                                "last_share_ip" => "164.90.191.249",
//                                "reject_percent" => "0.0000",
//                                "first_share_time" => 1697533935,
//                                "miner_agent" => "",
//                                "shares_unit" => "T",
//                                "status" => "INACTIVE",
//                                "shares_1h" => 0,
//                                "shares_1d" => "106.52",
//                                "shares_1m_pure" => "123850822272068",
//                                "shares_5m_pure" => "123850879538299",
//                                "shares_15m_pure" => "123850879538299",
//                                "shares_1h_pure" => 0,
//                                "shares_1d_pure" => 0,
//                                "shares_1d_unit" => "T",
//                                "reject_percent_1d" => "0.0000",
//                            ]
//                        ]
//                    ])
//                ]
//            ],
//        ];
//    }
//
//    public function ungroupedWorkerListDataProvider(): array
//    {
//        return [
//            [
//                'ungroupedRemoteWorkerList' => [
//                    'data' => [
//                        [
//                            "gid" => 666666,
//                            "group_name" => "Ramaz",
//                            "worker_id" => "6140576275788688963",
//                            "worker_name" => "Ramaz.S19x10x110x0x66",
//                            "is_top" => false,
//                            "shares_1m" => "108.800",
//                            "shares_5m" => "108.800",
//                            "shares_15m" => "108.800",
//                            "accept_count" => "-",
//                            "last_share_time" => 1698327976,
//                            "last_share_ip" => "164.90.191.249",
//                            "reject_percent" => "0.0000",
//                            "first_share_time" => 1688726898,
//                            "miner_agent" => "",
//                            "shares_unit" => "T",
//                            "status" => "ACTIVE",
//                            "shares_1h" => 0,
//                            "shares_1d" => "121.31",
//                            "shares_1m_pure" => "108838623082359",
//                            "shares_5m_pure" => "108838651715475",
//                            "shares_15m_pure" => "108838651715475",
//                            "shares_1h_pure" => 0,
//                            "shares_1d_pure" => 0,
//                            "shares_1d_unit" => "T",
//                            "reject_percent_1d" => "0.0000",
//                        ],
//                        [
//                            "gid" => 6003108,
//                            "group_name" => "evgen789",
//                            "worker_id" => "-3844127170179888225",
//                            "worker_name" => "evgen789.10x102x0x72",
//                            "is_top" => false,
//                            "shares_1m" => "123.800",
//                            "shares_5m" => "123.800",
//                            "shares_15m" => "123.800",
//                            "accept_count" => "-",
//                            "last_share_time" => 1698327976,
//                            "last_share_ip" => "164.90.191.249",
//                            "reject_percent" => "0.0000",
//                            "first_share_time" => 1697533935,
//                            "miner_agent" => "",
//                            "shares_unit" => "T",
//                            "status" => "INACTIVE",
//                            "shares_1h" => 0,
//                            "shares_1d" => "106.52",
//                            "shares_1m_pure" => "123850822272068",
//                            "shares_5m_pure" => "123850879538299",
//                            "shares_15m_pure" => "123850879538299",
//                            "shares_1h_pure" => 0,
//                            "shares_1d_pure" => 0,
//                            "shares_1d_unit" => "T",
//                            "reject_percent_1d" => "0.0000",
//                        ]
//                    ]
//                ],
//                'expectedTransform' => [
//                    [
//                        'worker_hash_rate' => WorkerHashRateData::fromRequest([
//                            'worker_id' => 6140576275788688963,
//                            'hash' => 108.800,
//                            'unit' => 'T',
//                        ]),
//                        'worker_data' => WorkerData::fromRequest([
//                            'group_id' => 666666,
//                            'worker_id' => 6140576275788688963,
//                            'name' => "Ramaz.S19x10x110x0x66",
//                            'approximate_hash_rate' => 108.800,
//                            'status' => "ACTIVE",
//                            'unit' => 'T',
//                            'pool_data' => [
//                                "gid" => 666666,
//                                "group_name" => "Ramaz",
//                                "worker_id" => "6140576275788688963",
//                                "worker_name" => "Ramaz.S19x10x110x0x66",
//                                "is_top" => false,
//                                "shares_1m" => "108.800",
//                                "shares_5m" => "108.800",
//                                "shares_15m" => "108.800",
//                                "accept_count" => "-",
//                                "last_share_time" => 1698327976,
//                                "last_share_ip" => "164.90.191.249",
//                                "reject_percent" => "0.0000",
//                                "first_share_time" => 1688726898,
//                                "miner_agent" => "",
//                                "shares_unit" => "T",
//                                "status" => "ACTIVE",
//                                "shares_1h" => 0,
//                                "shares_1d" => "121.31",
//                                "shares_1m_pure" => "108838623082359",
//                                "shares_5m_pure" => "108838651715475",
//                                "shares_15m_pure" => "108838651715475",
//                                "shares_1h_pure" => 0,
//                                "shares_1d_pure" => 0,
//                                "shares_1d_unit" => "T",
//                                "reject_percent_1d" => "0.0000",
//                            ]
//                        ])
//                    ],
//                    [
//                        'worker_hash_rate' => WorkerHashRateData::fromRequest([
//                            'worker_id' => -3844127170179888225,
//                            'hash' => 123.800,
//                            'unit' => 'T',
//                        ]),
//                        'worker_data' => WorkerData::fromRequest([
//                            'group_id' => 6003108,
//                            'worker_id' => -3844127170179888225,
//                            'name' => "evgen789.10x102x0x72",
//                            'approximate_hash_rate' => 123.800,
//                            'status' => "INACTIVE",
//                            'unit' => 'T',
//                            'pool_data' => [
//                                "gid" => 6003108,
//                                "group_name" => "evgen789",
//                                "worker_id" => "-3844127170179888225",
//                                "worker_name" => "evgen789.10x102x0x72",
//                                "is_top" => false,
//                                "shares_1m" => "123.800",
//                                "shares_5m" => "123.800",
//                                "shares_15m" => "123.800",
//                                "accept_count" => "-",
//                                "last_share_time" => 1698327976,
//                                "last_share_ip" => "164.90.191.249",
//                                "reject_percent" => "0.0000",
//                                "first_share_time" => 1697533935,
//                                "miner_agent" => "",
//                                "shares_unit" => "T",
//                                "status" => "INACTIVE",
//                                "shares_1h" => 0,
//                                "shares_1d" => "106.52",
//                                "shares_1m_pure" => "123850822272068",
//                                "shares_5m_pure" => "123850879538299",
//                                "shares_15m_pure" => "123850879538299",
//                                "shares_1h_pure" => 0,
//                                "shares_1d_pure" => 0,
//                                "shares_1d_unit" => "T",
//                                "reject_percent_1d" => "0.0000",
//                            ]
//                        ]),
//                    ]
//                ]
//            ]
//        ];
//    }
//
//    private function makeFakeRequestToBtcCom($shouldResponse): void
//    {
//        Http::fake([
//            config('api.btc.uri') . '/*' => Http::response($shouldResponse)
//        ]);
//    }
//}
