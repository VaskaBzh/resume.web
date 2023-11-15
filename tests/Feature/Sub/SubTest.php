<?php

declare(strict_types=1);

namespace Tests\Feature\Sub;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SubTest extends TestCase
{
    public User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::find(3);
    }

    /**
     * @test
     *
     * @testdox in show single sub
     *
     * @dataProvider subDataProvider
     */
    public function show(array $btcComOneSubResponse, array $expectedSubCollection)
    {
        Http::fake([
            '*' => Http::response(['data' => $btcComOneSubResponse]),
        ]);

        Sanctum::actingAs($this->user);


        $this->getJson(route('v1.sub.show', $this->user->subs()->first()->group_id))
            ->assertExactJson([

            ]);
    }

    public function subDataProvider(): array
    {
        return [
            'btcComResponse' => [
                'btcComOneSubResponse' => [
                    'gid' => 5,
                    'name' => 'CommonSub',
                    'created_at' => 1681501367,
                    'updated_at' => 1681501367,
                    'workers_active' => 1,
                    'workers_inactive' => 0,
                    'workers_dead' => 0,
                    'shares_1m' => 105,
                    'shares_5m' => '75.060',
                    'shares_15m' => '75.060',
                    'reject_percent' => '0.0000',
                    'workers_total' => 1,
                    'sort_id' => 5,
                    'shares_unit' => 'T',
                    'shares_1h' => 0,
                    'shares_1d' => 100,
                    'shares_1m_pure' => '75061139114121',
                    'shares_5m_pure' => '75061139114121',
                    'shares_15m_pure' => '75061139114121',
                    'shares_1h_pure' => 0,
                    'shares_1d_pure' => 0,
                ],
                'btcComListResponse' => [
                    'list' => [
                        ['gid' => -1],
                        ['gid' => 0],
                        [
                            'gid' => 5,
                            'name' => 'CommonSub',
                            'created_at' => 1681501367,
                            'updated_at' => 1681501367,
                            'workers_active' => 1,
                            'workers_inactive' => 0,
                            'workers_dead' => 0,
                            'shares_1m' => 105,
                            'shares_5m' => '75.060',
                            'shares_15m' => '75.060',
                            'reject_percent' => '0.0000',
                            'workers_total' => 1,
                            'sort_id' => 5,
                            'shares_unit' => 'T',
                            'shares_1h' => 0,
                            'shares_1d' => 0,
                            'shares_1m_pure' => '75061139114121',
                            'shares_5m_pure' => '75061139114121',
                            'shares_15m_pure' => '75061139114121',
                            'shares_1h_pure' => 0,
                            'shares_1d_pure' => 0,
                        ],
                        [
                            'workers_active' => 0,
                            'workers_inactive' => 0,
                            'workers_dead' => 3,
                            'shares_1m' => 108,
                            'shares_5m' => '0.00',
                            'shares_15m' => '0',
                            'workers_total' => 0,
                            'reject_percent' => '0.00',
                            'shares_unit' => 'T',
                            'gid' => 777777,
                            'sort_id' => 6002031,
                            'name' => 'MainTest2',
                            'created_at' => 1682499803,
                            'updated_at' => 1682499803,
                        ],
                        [
                            'workers_active' => 0,
                            'workers_inactive' => 0,
                            'workers_dead' => 0,
                            'shares_1m' => '0.00',
                            'shares_5m' => '0.00',
                            'shares_15m' => '0',
                            'workers_total' => 0,
                            'reject_percent' => '0.00',
                            'shares_unit' => 'T',
                            'gid' => 6002059,
                            'sort_id' => 6002059,
                            'name' => 'MontereyMining77',
                            'created_at' => 1682673065,
                            'updated_at' => 1682673065,
                        ],
                    ],
                ],
                'expectedSubCollection' => [
                    [
                        'sub' => 'MainTest',
                        'user_id' => 1,
                        'pending_amount' => 0.0,
                        'group_id' => 666666,
                        'workers_count_active' => 0,
                        'workers_count_inactive' => 0,
                        'workers_count_unstable' => 0,
                        'hash_per_min' => 105,
                        'hash_per_day' => 0.0,
                        'today_forecast' => '0.00000000',
                        'reject_percent' => 0.0,
                        'hash_per_day_unit' => 'G',
                        'hash_per_min_unit' => 'T',
                        'total_payout' => 0,
                        'yesterday_amount' => 0.0,
                        'last_month_amount' => 0.0,
                        'total_amount' => 0.0,
                    ],
                    [
                        'sub' => 'MainTest2',
                        'user_id' => 1,
                        'pending_amount' => 0.0,
                        'group_id' => 777777,
                        'workers_count_active' => 0,
                        'workers_count_inactive' => 0,
                        'workers_count_unstable' => 0,
                        'hash_per_min' => 108,
                        'hash_per_day' => 0.0,
                        'today_forecast' => '0.00000000',
                        'reject_percent' => 0.0,
                        'hash_per_day_unit' => 'G',
                        'hash_per_min_unit' => 'T',
                        'total_payout' => 0,
                        'yesterday_amount' => 0.0,
                        'last_month_amount' => 0.0,
                        'total_amount' => 0.0,
                    ],
                ],
            ],
        ];
    }
}
