<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Enums\Income\Type;
use App\Models\Hash;
use App\Models\Income;
use App\Models\User;
use App\Utils\HashRateConverter;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StatisticTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::first();
        $this->user->markEmailAsVerified();
        $this->sub = $this->user->subs()->first();
        Sanctum::actingAs($this->user);
        $this->incomes = Income::insert([
            [
                'group_id' => $this->sub->group_id,
                'type' => Type::MINING->value,
                'daily_amount' => 0.00400000,
                'status' => Status::COMPLETED->value,
                'message' => Message::COMPLETED->value,
                'hash' => 100,
                'unit' => 'T',
                'diff' => 57321508229258,
                'created_at' => now()->subDay(),
            ],
            [
                'group_id' => $this->sub->group_id,
                'type' => Type::MINING->value,
                'daily_amount' => 0.00400000,
                'status' => Status::COMPLETED->value,
                'message' => Message::COMPLETED->value,
                'hash' => 100,
                'unit' => 'T',
                'diff' => 57321508229258,
                'created_at' => now(),
            ],
        ]);
        $this->hashes = $this->sub
            ->hashes()
            ->select('hash', 'unit', 'worker_count')
            ->get();
    }

    /**
     * @test
     *
     * @testdox it show sub-account statistic
     */
    public function show(): void
    {
        $this->getJson(route('v1.statistic.show', $this->sub))
            ->assertOk()
            ->assertExactJson([
                'hashes' => $this->hashes->map(function (Hash $hash) {

                    $hashRate = HashRateConverter::fromPure($hash->hash);

                    return [
                        'hash' => (float) $hashRate->value,
                        'unit' => $hashRate->unit,
                        'worker_count' => $hash->worker_count,
                    ];
                }),
                'incomes' => [
                    [
                        'type' => Type::MINING->value,
                        'amount' => '0.00400000',
                        'payout' => null,
                        'hash' => 100,
                        'unit' => 'T',
                        'status' => 'done',
                        'income_at' => now()->toDateTimeString(),
                        'payout_at' => null,
                        'tx_id' => null,
                        'wallet' => null,
                    ],
                    [
                        'type' => Type::MINING->value,
                        'amount' => '0.00400000',
                        'payout' => null,
                        'hash' => 100,
                        'unit' => 'T',
                        'status' => 'done',
                        'income_at' => now()->subDay()->toDateTimeString(),
                        'payout_at' => null,
                        'tx_id' => null,
                        'wallet' => null,
                    ],
                ],
            ]);
    }
}
