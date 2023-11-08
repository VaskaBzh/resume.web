<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Utils\Helper;
use App\Models\MinerStat;
use App\Models\Sub;
use App\Models\User;
use App\Models\Worker;
use App\Enums\Income\Type;
use App\Enums\Income\Status;
use App\Enums\Income\Message;
use App\Services\Internal\IncomeService;
use App\Services\External\BtcComService;
use App\Exceptions\IncomeCreatingException;
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
     */
    public function it_failed_if_sub_without_hash_rate()
    {
        $this->expectException(IncomeCreatingException::class);
        resolve(IncomeService::class)->init(Sub::find(5), null);
    }

    /**
     * @test
     */
    public function it_create_mining_income_and_update_sub_accounts()
    {
        $subsCollection = Sub::hashWorkerHashRate()->get();

        $subWithHashRate = $subsCollection->where('group_id', 6)->first();

        $service = resolve(IncomeService::class)->init($subWithHashRate, null);

        $service->createIncome($subWithHashRate, Type::MINING);
        $service->updateLocalSub($subWithHashRate, Type::MINING);
        $service->createFinance();

        $hashrate = $subWithHashRate->total_hash_rate;
        dd($hashrate);
        $expectFirstDayAmount = $this->getDailyAmount($hashrate, BtcComService::FEE + 3.5);

        $this->assertDatabaseHas('incomes', [
            'group_id' => $subWithHashRate->group_id,
            'type' => Type::MINING->value,
            'daily_amount' => $expectFirstDayAmount,
            'status' => Status::PENDING->value,
            'message' => Message::LESS_MIN_WITHDRAWAL->value,
            'hash' => $hashrate,
        ]);
        $this->assertDatabaseHas('subs', [
            'user_id' => $subWithHashRate->user_id,
            'group_id' => $subWithHashRate->group_id,
            'sub' => $subWithHashRate->sub,
            'pending_amount' => $expectFirstDayAmount,
            'total_amount' => $expectFirstDayAmount,
        ]);

        $subWithHashRate->refresh();

        $this->createAdditionalWorkers();
        $hashrate = $subWithHashRate->total_hash_rate;
        $expectSecondDayAmount = $this->getDailyAmount($hashrate, BtcComService::FEE + 3.5);


        $service = resolve(IncomeService::class)->init($subWithHashRate, null);

        $service->createIncome($subWithHashRate, Type::MINING);
        $service->updateLocalSub($subWithHashRate, Type::MINING);
        $service->createFinance();

        $this->assertDatabaseHas('incomes', [
            'group_id' => $subWithHashRate->group_id,
            'type' => Type::MINING->value,
            'daily_amount' => $expectSecondDayAmount,
            'status' => Status::READY_TO_PAYOUT->value,
            'message' => Message::READY_TO_PAYOUT->value,
            'hash' => $hashrate,
        ]);
        $this->assertDatabaseHas('subs', [
            'user_id' => $subWithHashRate->user_id,
            'group_id' => $subWithHashRate->group_id,
            'sub' => $subWithHashRate->sub,
            'pending_amount' => $expectFirstDayAmount + $expectSecondDayAmount,
            'total_amount' => $expectFirstDayAmount + $expectSecondDayAmount,
        ]);
    }

    /**
     * @test
     */
    public function it_create_referral_income_and_update_sub_accounts()
    {
        $this->subWithHashRate->user->update([
            'referrer_id' => $this->referrer->id,
        ]);

        $service = resolve(IncomeService::class)->init(
            sub: $this->subWithHashRate,
            referrerSub: $this->referrerSub
        );

        $service->createIncome($this->subWithHashRate, Type::MINING);
        $service->updateLocalSub($this->subWithHashRate, Type::MINING);
        $service->createFinance();

        $service->createIncome($this->referrerSub, Type::REFERRAL);
        $service->updateLocalSub($this->referrerSub, Type::REFERRAL);

        $hashrate = $this->subWithHashRate->total_hash_rate;

        $expectReferralDayAmount = $this->getDailyAmount($hashrate, BtcComService::FEE + 3.5);
        $expectReferrerDailyAmount = number_format(
            $this->getDailyAmount($hashrate, 0) * ($this->subWithHashRate->referral_percent ?? $this->referrer->referral_percent / 100),
            8,
            '.',
            ''
        );


        $this->assertDatabaseHas('incomes', [
            'group_id' => $this->subWithHashRate->group_id,
            'type' => Type::MINING->value,
            'daily_amount' => $expectReferralDayAmount,
            'status' => Status::PENDING->value,
            'message' => Message::LESS_MIN_WITHDRAWAL->value,
            'hash' => $hashrate,
        ]);
        $this->assertDatabaseHas('incomes', [
            'group_id' => $this->referrerSub->group_id,
            'type' => Type::REFERRAL->value,
            'referral_id' => $this->subWithHashRate->user->id,
            'daily_amount' => $expectReferrerDailyAmount,
            'status' => Status::PENDING->value,
            'message' => Message::LESS_MIN_WITHDRAWAL->value,
            'hash' => $hashrate,
        ]);
        $this->assertDatabaseHas('subs', [
            'user_id' => $this->referrer->id,
            'group_id' => $this->referrerSub->group_id,
            'sub' => $this->referrerSub->sub,
            'pending_amount' => $expectReferrerDailyAmount,
            'total_amount' => $expectReferrerDailyAmount,
        ]);
    }


    /**
     * @test
     */
    public function it_create_income_with_referral_discount_and_update_sub_account()
    {
        $this->subWithHashRate->user->update([
            'referrer_id' => $this->referrer->id,
            'referral_discount' => 1,
        ]);

        $service = resolve(IncomeService::class)->init(
            sub: $this->subWithHashRate,
            referrerSub: $this->referrerSub
        );

        $hashrate = $this->subWithHashRate->total_hash_rate;
        $expectedDailyAmount = $this->getDailyAmount(
            $hashrate,
            (3.5 - $this->subWithHashRate->user->referral_discount) + BtcComService::FEE,
        );

        $service->createIncome($this->subWithHashRate, Type::MINING);
        $service->updateLocalSub($this->subWithHashRate, Type::MINING);
        $service->createFinance();

        $this->assertDatabaseHas('incomes', [
            'group_id' => $this->subWithHashRate->group_id,
            'type' => Type::MINING->value,
            'daily_amount' => $expectedDailyAmount,
            'status' => Status::PENDING->value,
            'message' => Message::LESS_MIN_WITHDRAWAL->value,
            'hash' => $hashrate,
        ]);
        $this->assertDatabaseHas('subs', [
            'user_id' => $this->subWithHashRate->user_id,
            'group_id' => $this->subWithHashRate->group_id,
            'sub' => $this->subWithHashRate->sub,
            'pending_amount' => $expectedDailyAmount,
            'total_amount' => $expectedDailyAmount,
        ]);
    }

    private function getDailyAmount(float $hashRate, $fee): float
    {
        return (float)number_format(Helper::calculateEarn(
            stats: $this->stat,
            hashRate: $hashRate,
            fee: $fee
        ), 8);
    }

    public function seedSequence(): void
    {
        User::factory()
            ->count(2)
            ->state(new Sequence(
                    [
                        'id' => 1,
                        'name' => "Referrer",
                        'email' => 'first@gmail.com',
                        'password' => bcrypt('password'),
                        'referral_percent' => 1,
                        'referral_discount' => 0,
                    ],
                    [
                        'id' => 2,
                        'name' => "Referral",
                        'email' => 'second@gmail.com',
                        'password' => bcrypt('password'),
                        'referral_percent' => 1,
                        'referral_discount' => 0,
                    ],
                    [
                        'id' => 3,
                        'name' => "CommonSub",
                        'email' => 'first@gmail.com',
                        'password' => bcrypt('password'),
                        'referral_percent' => 0,
                        'referral_discount' => 0,
                    ],
                )
            )->create();

        Sub::factory()
            ->count(4)
            ->state(new Sequence(
                    [
                        'group_id' => 1,
                        'sub' => 'Referrer',
                        'allbtc_fee' => 3.5,
                        'pending_amount' => 0,
                        'is_active' => true,
                        'total_amount' => 0,
                        'user_id' => 1,
                    ],
                    [
                        'group_id' => 2,
                        'sub' => 'Referrer2',
                        'allbtc_fee' => 3.5,
                        'is_active' => false,
                        'pending_amount' => 0,
                        'total_amount' => 0,
                        'user_id' => 1,
                    ],
                    [
                        'group_id' => 3,
                        'sub' => 'Referral',
                        'allbtc_fee' => 3.5,
                        'is_active' => true,
                        'pending_amount' => 0,
                        'total_amount' => 0,
                        'user_id' => 2,
                    ],
                    [
                        'group_id' => 4,
                        'sub' => 'Referral2',
                        'allbtc_fee' => 3.5,
                        'is_active' => false,
                        'pending_amount' => 0,
                        'total_amount' => 0,
                        'user_id' => 2,
                    ],
                    [
                        'group_id' => 6,
                        'sub' => 'CommonSub',
                        'allbtc_fee' => 3.5,
                        'pending_amount' => 0,
                        'is_active' => true,
                        'total_amount' => 0,
                        'user_id' => 3,
                    ],
                )
            )->create();

        Worker::factory()
            ->count(2)
            ->state(new Sequence(
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
                        'status' => 'INACTIVE',
                        'approximate_hash_rate' => 0,
                        'group_id' => 4,
                    ],
                    [
                        'status' => 'ACTIVE',
                        'approximate_hash_rate' => 100,
                        'group_id' => 6,
                    ]
                )
            )->create();
    }

    public function createAdditionalWorkers(): void
    {
        $this->subWithHashRate->workers()->create([
            'status' => 'ACTIVE',
            'approximate_hash_rate' => 2270,
            'group_id' => $this->subWithHashRate->group_id,
            'worker_id' => mt_rand(1, 10),
        ]);
    }
}
