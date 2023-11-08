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
    public Sub $subWithHashRate;
    public Sub $subWithoutHashRate;
    public MinerStat $stat;
    public User $referrer;
    public Sub $referrerSub;

    protected function setUp(): void
    {
        parent::setUp();

        User::factory()->create()->count();
        $this->referrer = User::create([
            'name' => 'Referrer',
            'email' => 'referrer@referrer.com',
            'password' => bcrypt(123),
            'referral_percent' => 1,
            'referral_discount' => 0,
        ]);
        $this->referrerSub = Sub::create([
            'sub' => $this->referrer->name,
            'group_id' => 9999999,
            'user_id' => $this->referrer->id,
        ]);
        $this->subWithHashRate = Sub::factory()->create();
        $this->subWithoutHashRate = Sub::factory()->create();
        $this->stat = MinerStat::factory()->create();
        Worker::factory()
            ->count(2)
            ->state(new Sequence(
                    [
                        'status' => 'ACTIVE',
                        'approximate_hash_rate' => 100,
                        'group_id' => $this->subWithHashRate->group_id,
                    ],
                    [
                        'status' => 'INACTIVE',
                        'approximate_hash_rate' => 100,
                        'group_id' => $this->subWithHashRate->group_id,
                    ],
                    [
                        'status' => 'INACTIVE',
                        'approximate_hash_rate' => 0,
                        'group_id' => $this->subWithoutHashRate->group_id,
                    ]
                )
            )
            ->create();
    }

    /**
     * @test
     *
     */
    public function it_failed_if_sub_without_hash_rate()
    {
        $this->expectException(IncomeCreatingException::class);
        resolve(IncomeService::class)->init($this->subWithoutHashRate, null);
    }

    /**
     * @test
     */
    public function it_create_mining_income_and_update_sub_accounts()
    {
        $service = resolve(IncomeService::class)->init($this->subWithHashRate, null);

        $service->createIncome($this->subWithHashRate, Type::MINING);
        $service->updateLocalSub($this->subWithHashRate, Type::MINING);
        $service->createFinance();

        $hashrate = $this->subWithHashRate->total_hash_rate;
        $expectFirstDayAmount = $this->getDailyAmount($hashrate, BtcComService::FEE + 3.5);

        $this->assertDatabaseHas('incomes', [
            'group_id' => $this->subWithHashRate->group_id,
            'type' => Type::MINING->value,
            'daily_amount' => $expectFirstDayAmount,
            'status' => Status::PENDING->value,
            'message' => Message::LESS_MIN_WITHDRAWAL->value,
            'hash' => $hashrate,
        ]);
        $this->assertDatabaseHas('subs', [
            'user_id' => $this->subWithHashRate->user_id,
            'group_id' => $this->subWithHashRate->group_id,
            'sub' => $this->subWithHashRate->sub,
            'pending_amount' => $expectFirstDayAmount,
            'total_amount' => $expectFirstDayAmount,
        ]);

        $this->subWithHashRate->refresh();

        $this->createAdditionalWorkers();
        $hashrate = $this->subWithHashRate->total_hash_rate;
        $expectSecondDayAmount = $this->getDailyAmount($hashrate, BtcComService::FEE + 3.5);


        $service = resolve(IncomeService::class)->init($this->subWithHashRate, null);

        $service->createIncome($this->subWithHashRate, Type::MINING);
        $service->updateLocalSub($this->subWithHashRate, Type::MINING);
        $service->createFinance();

        $this->assertDatabaseHas('incomes', [
            'group_id' => $this->subWithHashRate->group_id,
            'type' => Type::MINING->value,
            'daily_amount' => $expectSecondDayAmount,
            'status' => Status::READY_TO_PAYOUT->value,
            'message' => Message::READY_TO_PAYOUT->value,
            'hash' => $hashrate,
        ]);
        $this->assertDatabaseHas('subs', [
            'user_id' => $this->subWithHashRate->user_id,
            'group_id' => $this->subWithHashRate->group_id,
            'sub' => $this->subWithHashRate->sub,
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
