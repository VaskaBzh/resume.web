<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Exceptions\BusinessException;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SubServiceTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::first();
        $this->user->markEmailAsVerified();
        Sanctum::actingAs($this->user);
    }

    /**
     * @test
     *
     * @testdox it show single sub
     *
     * @dataProvider subShowDataProvider
     */
    public function showSub($response, $expect)
    {
        $localSub = $this->user->subs()->first();

        $this->makeFakeRequestToRemotePool($response);

        $this->getJson(route('v1.sub.show', $localSub))
            ->assertOk()
            ->assertExactJson($expect);
    }

    /**
     * @test
     *
     * @testdox it show sub list
     *
     * @dataProvider subListDataProvider
     */
    public function showSubList($response, $showList)
    {
        $this->makeFakeRequestToRemotePool($response);

        $this->getJson(route('v1.sub.list', $this->user))
            ->assertOk()
            ->assertExactJson([
                'list' => $showList['list'],
                'overall' => $showList['overall'],
            ]);
    }

    /**
     * @test
     *
     * @testdox  it create remote and local sub
     *
     * @dataProvider subCreateDataProvider
     */
    public function createSub($successResponse)
    {
        $this->makeFakeRequestToRemotePool($successResponse);

        $this->postJson(route('v1.sub.create', $this->user), [
            'name' => 'TestName',
        ])
            ->assertCreated()
            ->assertExactJson(['message' => 'Subaccount successful created']);

        $this->assertDatabaseHas('subs', [
            'sub' => 'TestName',
            'group_id' => 666666,
            'allbtc_fee' => 3.5,
            'pending_amount' => 0,
            'total_amount' => 0,
        ]);
    }

    /**
     * @test
     *
     * @testdox it throw exception if sub account exist on remote pool
     */
    public function itThrowException(): void
    {
        $this->makeFakeRequestToRemotePool(['exist']);

        // $this->expectException(BusinessException::class);
        //$this->expectExceptionMessage(__('actions.sub_account_already_exist'));

        $this->postJson(route('v1.sub.create', $this->user), [
            'name' => 'TestName',
        ]);

        $this->assertDatabaseMissing('subs', ['user_id' => $this->user->id, 'sub' => 'TestName']);
    }

    public function subCreateDataProvider()
    {
        return [
            'success btc.com creating response' => [
                [
                    'status' => true,
                    'gid' => 666666,
                    'group_name' => 'TestName',
                    'created_at' => 1698151086,
                    'updated_at' => 1698151086,
                ],
            ],
        ];
    }

    public function subShowDataProvider(): array
    {
        return [
            'mocked btc.com sub' => [
                'remoteSub' => [
                    'gid' => 1,
                    'name' => 'MainTest',
                    'created_at' => 1681501367,
                    'updated_at' => 1681501367,
                    'workers_active' => 0,
                    'workers_inactive' => 0,
                    'workers_dead' => 3,
                    'shares_1m' => 105,
                    'shares_5m' => '75.060',
                    'shares_15m' => '75.060',
                    'reject_percent' => '0.0000',
                    'workers_total' => 1,
                    'sort_id' => '6001912',
                    'shares_unit' => 'T',
                    'shares_1h' => 0,
                    'shares_1d' => 0,
                    'shares_1m_pure' => '75061139114121',
                    'shares_5m_pure' => '75061139114121',
                    'shares_15m_pure' => '75061139114121',
                    'shares_1h_pure' => 0,
                    'shares_1d_pure' => 0,
                ],
                'showSub' => [
                    'name' => 'Referrer',
                    'group_id' => 1,
                    'workers_count_active' => 1,
                    'workers_count_inactive' => 1,
                    'workers_count_dead' => 0,
                    'hash_per_min' => 75.06,
                    'hash_per_day' => 100,
                    'today_forecast' => 0.00020771,
                    'hash_per_day_unit' => 'T',
                    'hash_per_min_unit' => 'T',
                    'total_payout' => 0,
                    'yesterday_amount' => 0,
                    'pending_amount' => 0,
                    'last_month_amount' => 0,
                    'total_amount' => 0,
                ],
            ],
        ];
    }

    public function subListDataProvider(): array
    {
        return [
            'mocked btc.com sub list' => [
                'response' => [
                    'list' => [
                        ['gid' => -1],
                        ['gid' => 0],
                        [
                            'gid' => 1,
                            'name' => 'Referrer',
                            'created_at' => 1681501367,
                            'updated_at' => 1681501367,
                            'workers_active' => 0,
                            'workers_inactive' => 0,
                            'workers_dead' => 3,
                            'shares_1m' => 105,
                            'shares_5m' => '75.060',
                            'shares_15m' => '75.060',
                            'reject_percent' => '0.0000',
                            'workers_total' => 1,
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
                            'gid' => 2,
                            'name' => 'Referrer2',
                            'created_at' => 1681501367,
                            'updated_at' => 1681501367,
                            'workers_active' => 0,
                            'workers_inactive' => 1,
                            'workers_dead' => 0,
                            'shares_1m' => 0,
                            'shares_5m' => 0,
                            'shares_15m' => 0,
                            'reject_percent' => 0,
                            'workers_total' => 1,
                            'shares_unit' => 'T',
                            'shares_1h' => 0,
                            'shares_1d' => 0,
                            'shares_1m_pure' => 0,
                            'shares_5m_pure' => 0,
                            'shares_15m_pure' => 0,
                            'shares_1h_pure' => 0,
                            'shares_1d_pure' => 0,
                        ],
                    ],
                ],
                'showList' => [
                    'list' => [
                        [
                            'name' => 'Referrer',
                            'group_id' => 1,
                            'workers_count_active' => 1,
                            'workers_count_inactive' => 1,
                            'workers_count_dead' => 0,
                            'hash_per_min' => 75.06,
                            'hash_per_day' => 100,
                            'today_forecast' => 0.00020771,
                            'hash_per_day_unit' => 'T',
                            'hash_per_min_unit' => 'T',
                            'total_payout' => 0,
                            'yesterday_amount' => 0,
                            'pending_amount' => 0,
                            'last_month_amount' => 0,
                            'total_amount' => 0,
                        ],
                        [
                            'name' => 'Referrer2',
                            'group_id' => 2,
                            'workers_count_active' => 0,
                            'workers_count_inactive' => 1,
                            'workers_count_dead' => 0,
                            'hash_per_min' => 0,
                            'hash_per_day' => 0,
                            'today_forecast' => 0,
                            'hash_per_day_unit' => 'T',
                            'hash_per_min_unit' => 'T',
                            'total_payout' => 0,
                            'yesterday_amount' => 0,
                            'pending_amount' => 0,
                            'last_month_amount' => 0,
                            'total_amount' => 0,
                        ],
                    ],
                    'overall' => [
                        'total_hash_per_day' => 100.00,
                        'total_hash_per_day_unit' => 'T',
                        'total_hash_per_min' => 75.06,
                        'total_hash_per_min_unit' => 'T',
                        'total_active_workers' => 1,
                        'total_inactive_workers' => 2,
                        'total_dead_workers' => 0,
                    ],
                ],
            ],
        ];
    }

    private function makeFakeRequestToRemotePool($shouldResponse): void
    {
        Http::fake([
            '*' => Http::response(['data' => $shouldResponse]),
        ]);
    }
}
