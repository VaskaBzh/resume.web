<?php

namespace Tests\Feature\Income;

use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Enums\Income\Type;
use App\Models\Income;
use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class IncomeTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::first();
        $this->user->markEmailAsVerified();
        $this->sub = $this->user->subs()->first();
        Sanctum::actingAs($this->user);
    }

    /**
     * @test
     *
     * @testdox it show income list without payout data
     */
    public function showListWithoutPayout()
    {
        $income = $this->sub->incomes()->create([
            'type' => Type::MINING->value,
            'daily_amount' => 0.00400000,
            'status' => Status::PENDING->value,
            'message' => Message::LESS_MIN_WITHDRAWAL->value,
            'hash' => 100,
            'unit' => 'T',
            'diff' => 57321508229258,
        ]);

        $this->getJson(route('v1.income.list', $this->sub))
            ->assertOk()
            ->assertExactJson(data: [
                'data' => [
                    [
                        'type' => Type::MINING->value,
                        'amount' => '0.00400000',
                        'payout' => null,
                        'hash' => 100,
                        'unit' => 'T',
                        'status' => __('statuses.'.Message::LESS_MIN_WITHDRAWAL->value),
                        'income_at' => $income->created_at->toDateTimeString(),
                        'payout_at' => null,
                        'tx_id' => null,
                        'wallet' => null,
                    ],
                ],
                'links' => [
                    'first' => 'http://localhost/v1/incomes/1?page=1',
                    'last' => 'http://localhost/v1/incomes/1?page=1',
                    'next' => null,
                    'prev' => null,
                ],
                'meta' => [
                    'current_page' => 1,
                    'from' => 1,
                    'last_page' => 1,
                    'links' => [
                        [
                            'active' => false,
                            'label' => '&laquo; Previous',
                            'url' => null,
                        ],
                        [
                            'active' => true,
                            'label' => '1',
                            'url' => 'http://localhost/v1/incomes/1?page=1',
                        ],
                        [
                            'active' => false,
                            'label' => 'Next &raquo;',
                            'url' => null,
                        ],
                    ],
                    'path' => 'http://localhost/v1/incomes/1',
                    'per_page' => 15,
                    'to' => 1,
                    'total' => 1,
                ],
            ]);
    }

    /**
     * @test
     *
     * @testdox it show income list with payout
     */
    public function showListWithPayout(): void
    {
        $wallet = $this->sub->wallets()->create([
            'percent' => 100,
            'minWithdrawal' => 0.005,
            'wallet' => Str::random(20),
            'name' => Str::random(3),
        ]);

        Income::insert([
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

        $txId = Str::random(40);
        $this->sub->payouts()->create([
            'wallet_id' => $wallet->id,
            'payout' => 0.00500000,
            'txid' => $txId,
            'created_at' => now(),
        ]);

        $this->getJson(route('v1.income.list', $this->sub))
            ->assertOk()
            ->assertExactJson(data: [
                'data' => [
                    [
                        'type' => Type::MINING->value,
                        'amount' => '0.00400000',
                        'payout' => '0.00500000',
                        'hash' => 100,
                        'unit' => 'T',
                        'status' => __('statuses.'.Message::COMPLETED->value),
                        'income_at' => now()->toDateTimeString(),
                        'payout_at' => now()->toDateTimeString(),
                        'tx_id' => $txId,
                        'wallet' => $wallet->wallet,
                    ],
                    [
                        'type' => Type::MINING->value,
                        'amount' => '0.00400000',
                        'payout' => null,
                        'hash' => 100,
                        'unit' => 'T',
                        'status' => __('statuses.'.Message::COMPLETED->value),
                        'income_at' => now()->subDay()->toDateTimeString(),
                        'payout_at' => null,
                        'tx_id' => null,
                        'wallet' => null,
                    ],
                ],
                'links' => [
                    'first' => 'http://localhost/v1/incomes/1?page=1',
                    'last' => 'http://localhost/v1/incomes/1?page=1',
                    'next' => null,
                    'prev' => null,
                ],
                'meta' => [
                    'current_page' => 1,
                    'from' => 1,
                    'last_page' => 1,
                    'links' => [
                        [
                            'active' => false,
                            'label' => '&laquo; Previous',
                            'url' => null,
                        ],
                        [
                            'active' => true,
                            'label' => '1',
                            'url' => 'http://localhost/v1/incomes/1?page=1',
                        ],
                        [
                            'active' => false,
                            'label' => 'Next &raquo;',
                            'url' => null,
                        ],
                    ],
                    'path' => 'http://localhost/v1/incomes/1',
                    'per_page' => 15,
                    'to' => 2,
                    'total' => 2,
                ],
            ]);
    }
}
