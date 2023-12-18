<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Enums\Income\Status;
use App\Enums\Income\Type;
use App\Models\Sub;
use App\Services\Internal\IncomeService;
use App\Utils\HashRateConverter;
use App\Utils\Helper;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class IncomeServiceTest extends TestCase
{
    public Collection $subsWithHashRate;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subsWithHashRate = Sub::hasWorkerHashRate()
            ->with(['user', 'user.referrer'])
            ->get();
    }

    /**
     * @test
     *
     * @testdox it not create income if sub account hasn't a hash rate
     */
    public function hasNotHashRate(): void
    {
        $subWithoutHashRate = Sub::find(2);

        IncomeService::init($this->stat, $subWithoutHashRate, null);

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
     * @testdox it create mining type income and update sub account amounts if wallet not exists
     */
    public function miningIncomeCase(): void
    {
        $subWithHashRate = $this->subsWithHashRate
            ->where('group_id', 1)
            ->first();

        $service = IncomeService::init($this->stat, $subWithHashRate, null);

        $service->createIncome($subWithHashRate, Type::MINING);
        $service->updateLocalSub($subWithHashRate, Type::MINING);
        $service->createFinance();

        $hashrate = $subWithHashRate->hash_rate;

        $getPureDailyEarning = $this->calculate($hashrate);
        $expectDailyAmount = $this->calculate($hashrate, config('api.btc.fee') + 3.5);
        $convertedHashRate = HashRateConverter::fromPure($hashrate);

        $this->assertDatabaseHas('incomes', [
            'group_id' => $subWithHashRate->group_id,
            'type' => Type::MINING->value,
            'daily_amount' => number_format($expectDailyAmount, 8, '.', ''),
            'status' => Status::NO_WALLET->value,
            'hash' => $convertedHashRate->value,
            'unit' => $convertedHashRate->unit,
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
            'earn' => number_format($getPureDailyEarning - $getPureDailyEarning * (config('api.btc.fee') / 100),
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
        $subWithHashRate = $this->subsWithHashRate
            ->where('group_id', 1)
            ->first();

        $subWithHashRate->update(['pending_amount' => 1, 'total_amount' => 1]);
        $subWithHashRate->save();

        $expectDailyAmount = $this->calculate($subWithHashRate->hash_rate, config('api.btc.fee') + 3.5);

        $service = IncomeService::init($this->stat, $subWithHashRate, null);

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
     * @testdox if wallet on verify
     */
    public function referralIncomeCommonCase()
    {

        $referralSub = $this->subsWithHashRate
            ->where('group_id', 3)
            ->first();

        $referrer = $referralSub->user->referrer;

        $referrerActiveSub = $referrer
            ->activeSub()
            ->first();

        $this->assertEquals($referrerActiveSub->group_id, $referrer->active_sub);

        $service = IncomeService::init($this->stat, $referralSub, $referralSub);

        $service->createIncome($referrerActiveSub, Type::REFERRAL);
        $service->updateLocalSub($referrerActiveSub, Type::REFERRAL);

        $hashrate = $referralSub->hash_rate;

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
            'status' => Status::ON_VERIFY->value,
            'hash' => HashRateConverter::fromPure($hashrate)->value,
        ]);
    }

    /**
     * @test
     *
     * @testdox It create income with referral discount
     */
    public function referralDiscountCase()
    {
        $referralSub = $this->subsWithHashRate->where('group_id', 3)->first();
        $referralSub->user->update(['referral_discount' => 1]);
        $referralSub->wallets->first()->update(['wallet_updated_at' => now()->subHours(48)]);

        $service = IncomeService::init($this->stat, $referralSub, null);

        $hashrate = $referralSub->hash_rate;

        $subDiscountedFee = $referralSub->allbtc_fee - $referralSub->user->referral_discount;
        $resultFee = config('api.btc.fee') + $subDiscountedFee;

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
            'hash' => HashRateConverter::fromPure($hashrate)->value,
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
            'earn' => number_format($pureDailyEarning - $pureDailyEarning * (config('api.btc.fee') / 100),
                8,
                '.',
                ''
            ),
            'user_total' => $expectDailyAmount,
            'percent' => $resultFee - config('api.btc.fee'),
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
}
