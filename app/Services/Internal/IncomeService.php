<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\Finance\Create;
use App\Actions\Income\Create as IncomeCreate;
use App\Actions\Sub\Update;
use App\Dto\FinanceData;
use App\Dto\Income\IncomeCreateData;
use App\Dto\Sub\SubUpsertData;
use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Enums\Income\Type;
use App\Exceptions\IncomeCreatingException;
use App\Models\Income;
use App\Models\MinerStat;
use App\Models\Sub;
use App\Models\Wallet;
use App\Services\External\BtcComService;
use App\Utils\Helper;
use Illuminate\Support\Facades\Log;

final class IncomeService
{
    /**
     * Global mining stats (net difficulty, reward block, etc)
     */
    private MinerStat $stat;

    /**
     * Local sub-account
     */
    private Sub $sub;

    /**
     * Referrer sub-account
     */
    private ?Sub $referrerSub;

    /**
     * Referral percent
     */
    private float $referralPercent;

    /**
     * Referral discount
     */
    private float $referralDiscount;

    /**
     * Pure sub-account coin earning
     */
    private float $dailyEarn;

    /**
     * AllBtc commission
     */
    private float $fee;

    /**
     * Income parameters.
     *
     * @var array<string, string|float[]>
     */
    private array $params = [
        'mining' => [],
        'referral' => [],
        'hash' => null,
        'diff' => null,
    ];

    /**
     * Init service
     * Set sub-account
     *
     * @throws IncomeCreatingException
     */
    public function init(Sub $sub, ?Sub $referrerSub): IncomeService
    {
        $this->stat = MinerStat::first();
        $this->sub = $sub;
        $this->referrerSub = $referrerSub;
        $this->referralPercent = (float) $sub->user->referral_percent ?? $referrerSub->user->referral_percent;
        $this->referralDiscount = (float) $sub->user->referral_discount;

        if (! $this->setHashRate()) {
            throw new IncomeCreatingException(sprintf('Sub-account %s hasn\'t a hash rate!', $sub->sub));
        }

        $this->setParams();

        Log::channel('incomes')->info('INIT UPDATE INCOME PROCESS '.$sub->sub);

        return $this;
    }

    /**
     * Set sub-account params
     */
    private function setParams(): void
    {
        $this
            ->setFee()
            ->setNetworkDifficulty()
            ->setDailyEarn()
            ->setDailyAmount()
            ->setPendingAmount($this->sub, Type::MINING)
            ->setTotalAmount($this->sub, Type::MINING)
            ->setInfo($this->sub, Type::MINING);

        if ($this->referrerSub) {
            $this
                ->setReferrerProfit()
                ->setPendingAmount($this->referrerSub, Type::REFERRAL)
                ->setTotalAmount($this->referrerSub, Type::REFERRAL)
                ->setInfo($this->referrerSub, Type::REFERRAL);
        }
    }

    /**
     * Set allbtc fee, decrease them if referrer exists
     */
    private function setFee(): IncomeService
    {
        $this->fee = $this->sub->allbtc_fee - $this->referralDiscount;

        return $this;
    }

    /**
     * Set total hash rate
     */
    private function setHashRate(): bool
    {
        $this->params['hash'] = $this->sub->hash_rate;

        return $this->params['hash'] > 0;
    }

    private function setNetworkDifficulty(): IncomeService
    {
        $this->params['diff'] = $this->stat->network_difficulty;

        return $this;
    }

    /**
     * Set pure mining daily earn
     */
    private function setDailyEarn(): IncomeService
    {
        $this->dailyEarn = Helper::calculateEarn(
            stats: $this->stat,
            hashRate: $this->params['hash'],
            fee: 0
        );

        return $this;
    }

    /**
     * Set the daily earn after deducting the commission of allbtc and remote pool
     */
    private function setDailyAmount(): IncomeService
    {
        $this->params[Type::MINING->value]['dailyAmount'] = Helper::calculateEarn(
            stats: $this->stat,
            hashRate: $this->params['hash'],
            fee: BtcComService::FEE + $this->fee
        );

        return $this;
    }

    /**
     * Set sub-account daily amount until withdrawal limit
     */
    public function setPendingAmount(Sub $sub, Type $incomeType): IncomeService
    {
        $this->params[$incomeType->value]['pendingAmount'] = $sub->pending_amount + $this->params[$incomeType->value]['dailyAmount'];

        return $this;
    }

    /**
     * Set sub-account total amount for all time
     */
    public function setTotalAmount(Sub $sub, Type $incomeType): IncomeService
    {
        $this->params[$incomeType->value]['totalAmount'] = $this->params[$incomeType->value]['dailyAmount'] + $sub->total_amount;

        return $this;
    }

    /**
     * Set referrer profit if exits
     */
    public function setReferrerProfit(): IncomeService
    {
        $this->params[Type::REFERRAL->value]['dailyAmount'] = $this->dailyEarn * ($this->referralPercent / 100);

        return $this;
    }

    /**
     * Checking if pending limit has been reached
     */
    public function isReadyToPayOut(Sub $sub, Type $incomeType): bool
    {
        $dailyAmount = $this->params[$incomeType->value]['dailyAmount'];

        return ($sub->pending_amount + $dailyAmount) >= Wallet::MIN_BITCOIN_WITHDRAWAL;
    }

    /**
     * Set income message and status
     */
    public function setInfo(
        Sub $sub,
        Type $incomeType
    ): IncomeService {
        if ($this->isReadyToPayOut($sub, $incomeType)) {

            $this->params[$incomeType->value]['message'] = Message::READY_TO_PAYOUT;
            $this->params[$incomeType->value]['status'] = Status::READY_TO_PAYOUT;
        } else {

            $this->params[$incomeType->value]['message'] = Message::LESS_MIN_WITHDRAWAL;
            $this->params[$incomeType->value]['status'] = Status::PENDING;
        }

        return $this;
    }

    /**
     * Create income
     * Create referrer income if exists
     */
    public function createIncome(Sub $sub, Type $incomeType): Income
    {
        return IncomeCreate::execute(
            incomeCreateData: IncomeCreateData::fromRequest([
                'group_id' => $sub->group_id,
                'dailyAmount' => $this->params[$incomeType->value]['dailyAmount'],
                'type' => $incomeType,
                'referral_id' => $incomeType->value === 'referral' ? $this->sub->user->id : null,
                'status' => $this->params[$incomeType->value]['status'],
                'message' => $this->params[$incomeType->value]['message'],
                'hash' => $this->params['hash'],
                'diff' => $this->params['diff'],
            ])
        );
    }

    /**
     * Update local sub-account
     * Update local referrer sub-account if exists
     */
    public function updateLocalSub(Sub $sub, Type $incomeType): void
    {
        Update::execute(
            subData: SubUpsertData::fromRequest([
                'user_id' => $sub->user_id,
                'group_id' => $sub->group_id,
                'sub_name' => $sub->sub,
                'pending_amount' => $this->params[$incomeType->value]['pendingAmount'],
                'total_amount' => $this->params[$incomeType->value]['totalAmount'],
            ]),
            sub: $sub
        );
    }

    /**
     * Create finance record
     */
    public function createFinance(): void
    {
        Create::execute(financeData: FinanceData::fromRequest([
            'group_id' => $this->sub->group_id,
            'earn' => $this->dailyEarn - $this->dailyEarn * (BtcComService::FEE / 100),
            'user_total' => $this->params[Type::MINING->value]['dailyAmount'],
            'percent' => $this->fee,
            'profit' => $this->dailyEarn * ($this->fee / 100),
        ]));
    }
}
