<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Enums\Hash\Unit;
use App\Models\Sub;
use App\Models\User;
use App\Models\Worker;
use App\Services\Internal\WorkerService;
use App\Utils\HashRateConverter;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WorkerServiceTest extends TestCase
{
    public User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::first();
    }

    /**
     * @test
     *
     * @testdox it return empty collection if remote grouped worker list is empty
     */
    public function syncEmptyGroupedWorkerList(): void
    {
        $this->makeFakeRequestToRemotePool(['data' => []]);

        $actual = app(WorkerService::class)->sync(0, 'all');
        $this->assertTrue($actual instanceof Collection);
        $this->assertTrue($actual->isEmpty());
    }

    /**
     * @test
     *
     * @testdox it sync groped worker list
     *
     * @dataProvider groupedWorkerListDataProvider
     */
    public function syncGroupedWorkerList(array $response)
    {
        $this->makeFakeRequestToRemotePool($response);

        $this->assertDatabaseMissing('workers', [
            'worker_id' => $response['data'][2]['worker_id'],
        ]);

        app(WorkerService::class)->sync(0, 'all');

        foreach ($response['data'] as $worker) {
            $this->assertDatabaseHas('workers', [
                'group_id' => $worker['gid'],
                'worker_id' => $worker['worker_id'],
                'status' => $worker['status'],
                'name' => $worker['worker_name'],
                'hash_per_day' => HashRateConverter::toPure(
                    value: (float) $worker['shares_1d'],
                    unit: Unit::tryFrom($worker['shares_1d_unit'])
                )->value,
            ]);
        }
    }

    /**
     * @test
     *
     * @testdox Add new workers from ungrouped and update group by sub-account group_id
     *
     * @dataProvider ungroupedWorkerListDataProvider
     */
    public function addNewWorkers(array $response)
    {
        $this->makeFakeRequestToRemotePool($response);

        foreach ($response['data'] as $worker) {
            $this->assertDatabaseMissing('workers', [
                'worker_id' => $worker['worker_id'],
            ]);
        }

        app(WorkerService::class)->addNew(-1);

        foreach ($response['data'] as $worker) {
            $ownerId = Sub::where('sub', head(explode('.', $worker['worker_name'])))
                ->first()
                ->group_id;

            $this->assertDatabaseHas('workers', [
                'group_id' => $ownerId,
                'worker_id' => (int) $worker['worker_id'],
                'status' => $worker['status'],
                'name' => $worker['worker_name'],
                'hash_per_day' => HashRateConverter::toPure(
                    value: (float) $worker['shares_1d'],
                    unit: Unit::tryFrom($worker['shares_1d_unit'])
                )->value,
            ]);

            Http::assertSent(function ($request) use ($worker, $ownerId) {
                if ($request->method() === 'POST') {

                    return $request->url() == config('api.btc.url').config('api.btc.paths.update worker')
                        && $request['worker_id'] == (string) $worker['worker_id']
                        && $request['group_id'] == $ownerId;
                }
            });
        }
    }

    public function groupedWorkerListDataProvider(): array
    {
        return [
            'Transform mocked btc.com grouped worker response' => [
                'response' => [
                    'data' => [
                        [
                            'gid' => 1,
                            'group_name' => 'Referrer',
                            'worker_id' => 1111,
                            'worker_name' => 'Referrer.S19x10x110x0x66',
                            'is_top' => false,
                            'shares_1m' => '108.800',
                            'shares_5m' => '108.800',
                            'shares_15m' => '108.800',
                            'accept_count' => '-',
                            'last_share_time' => 1698327976,
                            'last_share_ip' => '164.90.191.249',
                            'reject_percent' => '0.0000',
                            'first_share_time' => 1688726898,
                            'miner_agent' => '',
                            'shares_unit' => 'T',
                            'status' => 'ACTIVE',
                            'shares_1h' => 0,
                            'shares_1d' => '121.31',
                            'shares_1m_pure' => '108838623082359',
                            'shares_5m_pure' => '108838651715475',
                            'shares_15m_pure' => '108838651715475',
                            'shares_1h_pure' => 0,
                            'shares_1d_pure' => 0,
                            'shares_1d_unit' => 'T',
                            'reject_percent_1d' => '0.0000',
                        ],
                        [
                            'gid' => 3,
                            'group_name' => 'Referral',
                            'worker_id' => 2222,
                            'worker_name' => 'Referral.10x102x0x72',
                            'is_top' => false,
                            'shares_1m' => '123.800',
                            'shares_5m' => '123.800',
                            'shares_15m' => '123.800',
                            'accept_count' => '-',
                            'last_share_time' => 1698327976,
                            'last_share_ip' => '164.90.191.249',
                            'reject_percent' => '0.0000',
                            'first_share_time' => 1697533935,
                            'miner_agent' => '',
                            'shares_unit' => 'T',
                            'status' => 'INACTIVE',
                            'shares_1h' => 0,
                            'shares_1d' => '106.52',
                            'shares_1m_pure' => '123850822272068',
                            'shares_5m_pure' => '123850879538299',
                            'shares_15m_pure' => '123850879538299',
                            'shares_1h_pure' => 0,
                            'shares_1d_pure' => 0,
                            'shares_1d_unit' => 'T',
                            'reject_percent_1d' => '0.0000',
                        ],
                        [
                            'gid' => 3,
                            'group_name' => 'Referral',
                            'worker_id' => 22222,
                            'worker_name' => 'Referral.10x102x0x72',
                            'is_top' => false,
                            'shares_1m' => '123.800',
                            'shares_5m' => '123.800',
                            'shares_15m' => '123.800',
                            'accept_count' => '-',
                            'last_share_time' => 1698327976,
                            'last_share_ip' => '164.90.191.249',
                            'reject_percent' => '0.0000',
                            'first_share_time' => 1697533935,
                            'miner_agent' => '',
                            'shares_unit' => 'T',
                            'status' => 'INACTIVE',
                            'shares_1h' => 0,
                            'shares_1d' => '106.52',
                            'shares_1m_pure' => '123850822272068',
                            'shares_5m_pure' => '123850879538299',
                            'shares_15m_pure' => '123850879538299',
                            'shares_1h_pure' => 0,
                            'shares_1d_pure' => 0,
                            'shares_1d_unit' => 'T',
                            'reject_percent_1d' => '0.0000',
                        ],
                    ],
                ],
            ],
        ];
    }

    public function ungroupedWorkerListDataProvider(): array
    {
        return [
            'Transform mocked btc.com ungrouped worker response' => [
                'response' => [
                    'data' => [
                        [
                            'gid' => -1,
                            'group_name' => null,
                            'worker_id' => '6140576275788688963',
                            'worker_name' => 'Referrer.S19x10x110x0x66',
                            'is_top' => false,
                            'shares_1m' => '108.800',
                            'shares_5m' => '108.800',
                            'shares_15m' => '108.800',
                            'accept_count' => '-',
                            'last_share_time' => 1698327976,
                            'last_share_ip' => '164.90.191.249',
                            'reject_percent' => '0.0000',
                            'first_share_time' => 1688726898,
                            'miner_agent' => '',
                            'shares_unit' => 'T',
                            'status' => 'ACTIVE',
                            'shares_1h' => 0,
                            'shares_1d' => '121.31',
                            'shares_1m_pure' => '108838623082359',
                            'shares_5m_pure' => '108838651715475',
                            'shares_15m_pure' => '108838651715475',
                            'shares_1h_pure' => 0,
                            'shares_1d_pure' => 0,
                            'shares_1d_unit' => 'T',
                            'reject_percent_1d' => '0.0000',
                        ],
                        [
                            'gid' => -1,
                            'group_name' => null,
                            'worker_id' => '-3844127170179888225',
                            'worker_name' => 'Referrer.10x102x0x72',
                            'is_top' => false,
                            'shares_1m' => '123.800',
                            'shares_5m' => '123.800',
                            'shares_15m' => '123.800',
                            'accept_count' => '-',
                            'last_share_time' => 1698327976,
                            'last_share_ip' => '164.90.191.249',
                            'reject_percent' => '0.0000',
                            'first_share_time' => 1697533935,
                            'miner_agent' => '',
                            'shares_unit' => 'T',
                            'status' => 'INACTIVE',
                            'shares_1h' => 0,
                            'shares_1d' => '106.52',
                            'shares_1m_pure' => '123850822272068',
                            'shares_5m_pure' => '123850879538299',
                            'shares_15m_pure' => '123850879538299',
                            'shares_1h_pure' => 0,
                            'shares_1d_pure' => 0,
                            'shares_1d_unit' => 'T',
                            'reject_percent_1d' => '0.0000',
                        ],
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
