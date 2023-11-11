<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Enums\Income\Type;
use App\Exceptions\IncomeCreatingException;
use App\Models\Income;
use App\Models\MinerStat;
use App\Models\Sub;
use App\Models\User;
use App\Models\Worker;
use App\Services\External\BtcComService;
use App\Services\Internal\IncomeService;
use App\Utils\Helper;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Tests\TestCase;

class IncomeServiceTest extends TestCase
{
    public MinerStat $stat;

    protected function setUp(): void
    {
        parent::setUp();

        $this->stat = MinerStat::factory()->create();
        $this->seedSequence();
    }

    /**
     * @test
     *
     * @testdox it throw exception if sub account hasn't a hash rate
     */
    public function hasNotHashRate(): void
    {
        $subWithoutHashRate = Sub::find(2);

        $this->expectException(IncomeCreatingException::class);
        (new IncomeService)->init($subWithoutHashRate, null);

        $this->assertDatabaseMissing('incomes', ['group_id' => $subWithoutHashRate->group_id]);
        $this->assertDatabaseMissing('finances', ['group_id' => $subWithoutHashRate->group_id]);
        $this->assertDatabaseHas('subs', [
            'group_id' => $subWithoutHashRate->group_id,
            'pending_amount' => 0,
            'total_amount' => 0,
        ]);
    }

    /**
     * @test
     *
     * @testdox it create mining type income and update sub account amounts
     */
    public function miningIncomeCase(): void
    {
        $subsCollection = Sub::hasWorkerHashRate()->get();

        $subWithHashRate = $subsCollection->where('group_id', 1)->first();

        $service = resolve(IncomeService::class)->init($subWithHashRate, null);

        $service->createIncome($subWithHashRate, Type::MINING);
        $service->updateLocalSub($subWithHashRate, Type::MINING);
        $service->createFinance();

        $hashrate = $subWithHashRate->total_hash_rate;

        $getPureDailyEarning = $this->calculate($hashrate);
        $expectDailyAmount = $this->calculate($hashrate, BtcComService::FEE + 3.5);

        $this->assertTrue($getPureDailyEarning > $expectDailyAmount);

        $this->assertDatabaseHas('incomes', [
            'group_id' => $subWithHashRate->group_id,
            'type' => Type::MINING->value,
            'daily_amount' => number_format($expectDailyAmount, 8, '.', ''),
            'status' => Status::PENDING->value,
            'message' => Message::LESS_MIN_WITHDRAWAL->value,
            'hash' => $hashrate,
        ]);
        $this->assertDatabaseHas('subs', [
            'user_id' => $subWithHashRate->user_id,
            'group_id' => $subWithHashRate->group_id,
            'sub' => $subWithHashRate->sub,
            'pending_amount' => number_format($expectDailyAmount, 8, '.', ''),
            'total_amount' => number_format($expectDailyAmount, 8, '.', ''),
        ]);
        $this->assertDatabaseHas('finances', [
            'group_id' => $subWithHashRate->group_id,
            'earn' => number_format($getPureDailyEarning - $getPureDailyEarning * (BtcComService::FEE / 100),
                8,
                '.',
                ''
            ),
            'user_total' => number_format($expectDailyAmount, 8, '.', ''),
            'percent' => $subWithHashRate->allbtc_fee,
            'profit' => number_format($getPureDailyEarning * ($subWithHashRate->allbtc_fee / 100),
                8,
                '.',
                ''
            ),
        ]);
    }

    /**
     * @test
     *
     * @testdox it increment sub account amounts
     */
    public function updatedSubAmountsCase()
    {
        $subsCollection = Sub::hasWorkerHashRate()->get();

        $subWithHashRate = $subsCollection->where('group_id', 1)->first();
        $subWithHashRate->update(['pending_amount' => 1, 'total_amount' => 1]);
        $subWithHashRate->save();

        $expectDailyAmount = $this->calculate($subWithHashRate->total_hash_rate, BtcComService::FEE + 3.5);

        $service = resolve(IncomeService::class)->init($subWithHashRate, null);

        $service->createIncome($subWithHashRate, Type::MINING);
        $service->updateLocalSub($subWithHashRate, Type::MINING);
        $service->createFinance();

        $this->assertDatabaseHas('subs', [
            'user_id' => $subWithHashRate->user_id,
            'group_id' => $subWithHashRate->group_id,
            'sub' => $subWithHashRate->sub,
            'pending_amount' => number_format($expectDailyAmount + 1,
                8,
                '.',
                ''
            ),
            'total_amount' => number_format($expectDailyAmount + 1,
                8,
                '.',
                ''
            ),
        ]);
    }

    /**
     * @test
     *
     * @testdox it create referral income without referral discount based on default referral percent
     */
    public function referralIncomeCommonCase()
    {
        $subsCollection = Sub::hasWorkerHashRate()->with(['user', 'user.referrer'])->get();

        $referralSub = $subsCollection->where('group_id', 3)->first();

        $referrerActiveSub = $referralSub->user
            ->referrer
            ->active()
            ->first();

        $this->assertTrue($referrerActiveSub->is_active);

        $service = resolve(IncomeService::class)->init($referralSub, $referralSub);

        $service->createIncome($referrerActiveSub, Type::REFERRAL);
        $service->updateLocalSub($referrerActiveSub, Type::REFERRAL);

        $hashrate = $referralSub->total_hash_rate;

        $expectReferrerDailyAmount = number_format(
            $this->calculate($hashrate) * ($referralSub->user->referral_percent / 100),
            8,
            '.',
            ''
        );

        $this->assertDatabaseHas('incomes', [
            'group_id' => $referrerActiveSub->group_id,
            'type' => Type::REFERRAL->value,
            'referral_id' => $referralSub->user->id,
            'daily_amount' => $expectReferrerDailyAmount,
            'status' => Status::PENDING->value,
            'message' => Message::LESS_MIN_WITHDRAWAL->value,
            'hash' => $hashrate,
        ]);
    }

    /**
     * @test
     *
     * @testdox It create income with referral discount
     */
    public function referralDiscountCase()
    {
        $subsCollection = Sub::hasWorkerHashRate()->get();

        $referralSub = $subsCollection->where('group_id', 3)->first();
        $referralSub->user->update(['referral_discount' => 1]);

        $service = resolve(IncomeService::class)->init($referralSub, null);

        $hashrate = $referralSub->total_hash_rate;

        $subDiscountedFee = $referralSub->allbtc_fee - $referralSub->user->referral_discount;
        $resultFee = BtcComService::FEE + $subDiscountedFee;

        $pureDailyEarning = $this->calculate($hashrate);
        $expectDailyAmount = number_format($this->calculate($hashrate, $resultFee),
            8,
            '.',
            ''
        );

        $service->createIncome($referralSub, Type::MINING);
        $service->updateLocalSub($referralSub, Type::MINING);
        $service->createFinance();

        $this->assertDatabaseHas('incomes', [
            'group_id' => $referralSub->group_id,
            'type' => Type::MINING->value,
            'daily_amount' => $expectDailyAmount,
            'status' => Status::PENDING->value,
            'message' => Message::LESS_MIN_WITHDRAWAL->value,
            'hash' => $hashrate,
        ]);
        $this->assertDatabaseHas('subs', [
            'user_id' => $referralSub->user_id,
            'group_id' => $referralSub->group_id,
            'sub' => $referralSub->sub,
            'pending_amount' => $expectDailyAmount,
            'total_amount' => $expectDailyAmount,
        ]);
        $this->assertDatabaseHas('finances', [
            'group_id' => $referralSub->group_id,
            'earn' => number_format($pureDailyEarning - $pureDailyEarning * (BtcComService::FEE / 100),
                8,
                '.',
                ''
            ),
            'user_total' => $expectDailyAmount,
            'percent' => $resultFee - BtcComService::FEE,
            'profit' => number_format($pureDailyEarning * ($subDiscountedFee / 100),
                8,
                '.',
                ''
            ),
        ]);
    }

    private function calculate(float $hashRate, $fee = 0): float
    {
        return Helper::calculateEarn(
            stats: $this->stat,
            hashRate: $hashRate,
            fee: $fee
        );
    }

    public function seedSequence(): void
    {
        User::factory()
            ->count(3)
            ->sequence(
                [
                    'id' => 1,
                    'name' => 'Referrer',
                    'email' => 'first@gmail.com',
                    'password' => '123',
                    'referral_percent' => 1,
                    'referral_discount' => 0,
                ],
                [
                    'id' => 2,
                    'name' => 'Referral',
                    'email' => 'second@gmail.com',
                    'password' => '123',
                    'referrer_id' => 1,
                    'referral_percent' => 1,
                    'referral_discount' => 0,
                ],
                [
                    'id' => 3,
                    'name' => 'CommonSub',
                    'email' => 'third@gmail.com',
                    'password' => '123',
                    'referral_percent' => 0,
                    'referral_discount' => 0,
                ]
            )->afterCreating(function ($user) {
                match ($user->name) {
                    'Referrer' => Sub::factory()
                        ->count(2)
                        ->state(new Sequence(
                            [
                                'group_id' => 1,
                                'sub' => $user->name,
                                'allbtc_fee' => 3.5,
                                'pending_amount' => 0,
                                'is_active' => true,
                                'total_amount' => 0,
                                'user_id' => $user->id,
                            ],
                            [
                                'group_id' => 2,
                                'sub' => 'Referrer2',
                                'allbtc_fee' => 3.5,
                                'is_active' => false,
                                'pending_amount' => 0,
                                'total_amount' => 0,
                                'user_id' => $user->id,
                            ]
                        ))->create(),
                    'Referral' => Sub::factory()
                        ->count(2)
                        ->state(new Sequence(
                            [
                                'group_id' => 3,
                                'sub' => $user->name,
                                'allbtc_fee' => 3.5,
                                'is_active' => true,
                                'pending_amount' => 0,
                                'total_amount' => 0,
                                'user_id' => $user->id,
                            ],
                            [
                                'group_id' => 4,
                                'sub' => 'Referral2',
                                'allbtc_fee' => 3.5,
                                'is_active' => false,
                                'pending_amount' => 0,
                                'total_amount' => 0,
                                'user_id' => $user->id,
                            ],
                        ))->create(),
                    'CommonSub' => Sub::factory()->create(
                        [
                            'group_id' => 5,
                            'sub' => $user->name,
                            'allbtc_fee' => 3.5,
                            'pending_amount' => 0,
                            'is_active' => true,
                            'total_amount' => 0,
                            'user_id' => $user->id,
                        ]
                    ),
                    default => throw new \Exception('Wrong sub'),
                };
            })
            ->create();

        Worker::factory()
            ->count(6)
            ->sequence(
                [
                    'status' => 'INACTIVE',
                    'approximate_hash_rate' => 100,
                    'group_id' => 1,
                ],
                [
                    'status' => 'ACTIVE',
                    'approximate_hash_rate' => 100,
                    'group_id' => 1,
                ],
                [
                    'status' => 'INACTIVE',
                    'approximate_hash_rate' => 100,
                    'group_id' => 2,
                ],
                [
                    'status' => 'ACTIVE',
                    'approximate_hash_rate' => 100,
                    'group_id' => 3,
                ],
                [
                    'status' => 'INACTIVE',
                    'approximate_hash_rate' => 100,
                    'group_id' => 3,
                ],
                [
                    'status' => 'ACTIVE',
                    'approximate_hash_rate' => 100,
                    'group_id' => 5,
                ]
            )->create();
    }
}
