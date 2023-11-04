<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\Finance\Create;
use App\Actions\Income\Create as IncomeCreate;
use App\Actions\Sub\Update;
use App\Dto\FinanceData;
use App\Dto\Income\IncomeCreateData;
use App\Dto\SubData;
use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Enums\Income\Type;
use App\Models\MinerStat;
use App\Models\Sub;
use App\Models\User;
use App\Models\Wallet;
use App\Services\External\BtcComService;
use App\Utils\Helper;
use Illuminate\Support\Facades\Log;

final class IncomeService
{
    /**
     * Local sub-account
     *
     * @var Sub
     */
    private Sub $sub;

    /**
     * Global mining stats (net difficulty, reward block, etc)
     *
     * @var MinerStat
     */
    private MinerStat $stat;

    /**
     * Sub-account referrer
     * He makes profit from the sub-account
     *
     * @var User|null
     */
    private ?User $referrer;

    /**
     * Pure sub-account coin earning
     *
     * @var float
     */
    private float $dailyEarn;

    /**
     * AllBtc commission
     *
     * @var float
     */
    private float $fee;

    /**
     * Default params
     *
     * @var array
     */
    private array $params = [
        'status' => Status::REJECTED->value,
        'unit' => 'T',
        'totalPayment' => null,
    ];

    /**
     * Init service
     * Set sub-account
     *
     * @param Sub $sub
     * @return bool
     */
    public function init(Sub $sub): bool
    {
        $this->sub = $sub;
        $this->setDependencies();

        if (!$this->setHashRate()) {
            return false;
        }

        $this->setParams();

        Log::channel('incomes')
            ->info('INIT UPDATE INCOME PROCESS ' . $sub->sub);

        return true;
    }

    /**
     * Set referrer
     * Set mining stats
     *
     * @return void
     */
    private function setDependencies(): void
    {
        $this->referrer = $this->sub
            ->user
            ->referrer
            ?->load(['subs.wallets']);

        $this->stat = MinerStat::first();
    }

    /**
     * Set sub-account params
     *
     * @return void
     */
    private function setParams(): void
    {
        $this->setFee()
            ->setNetworkDifficulty()
            ->setDailyEarn()
            ->setDailyAmount()
            ->setPendingAmount()
            ->setTotalAmount();

        if ($this->referrer) {
            $this->setReferrerProfit();
        }
    }

    /**
     * Set allbtc fee, decrease them if referrer exists
     *
     * @return IncomeService
     */
    private function setFee(): IncomeService
    {
        $this->fee = $this->referrer
            ? $this->sub->allbtc_fee - $this->referrer->discount_percent
            : $this->sub->allbtc_fee;

        return $this;
    }

    /**
     * Set total hash rate
     *
     * @return bool
     */
    private function setHashRate(): bool
    {
        $this->params['hash'] = $this->sub->total_hash_rate;

        return $this->params['hash'] > 0;
    }

    /**
     * @return IncomeService
     */
    private function setNetworkDifficulty(): IncomeService
    {
        $this->params['diff'] = $this->stat->network_difficulty;

        return $this;
    }

    /**
     * Set pure mining daily earn
     *
     * @return IncomeService
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
     *
     * @return IncomeService
     */
    private function setDailyAmount(): IncomeService
    {
        $this->params['dailyAmount'] = Helper::calculateEarn(
            stats: $this->stat,
            hashRate: $this->params['hash'],
            fee: BtcComService::FEE + $this->fee
        );

        return $this;
    }

    /**
     * Set total amount
     *
     * @return IncomeService
     */
    public function setTotalAmount(): IncomeService
    {
        $this->params['totalAmount'] = $this->params['dailyAmount'] + $this->sub->total_amount;

        return $this;
    }

    /**
     * Set income message and status
     *
     * @param Message $message
     * @param Status  $status
     * @return IncomeService
     */
    public function setInfo(
        Message $message,
        Status  $status
    ): IncomeService
    {
        $this->params['message'] = $message->value;
        $this->params['status'] = $status->value;

        return $this;
    }

    /**
     * Set daily amount until withdrawal limit
     *
     * @return IncomeService
     */
    public function setPendingAmount(): IncomeService
    {
        $this->params['pendingAmount'] = $this->sub->pending_amount + $this->params['dailyAmount'];

        return $this;
    }

    /**
     * Set referrer profit if exits
     *
     * @return IncomeService
     */
    public function setReferrerProfit(): IncomeService
    {
        $this->params['referrerProfit'] = $this->dailyEarn * ($this->referrer->referral_percent / 100);

        return $this;
    }

    /**
     * Checking if pending limit has been reached
     *
     * @return bool
     */
    public function isReadyToPayOut(): bool
    {
        return ($this->sub->pending_amount + $this->params['dailyAmount']) >= Wallet::MIN_BITCOIN_WITHDRAWAL;
    }

    /**
     * Checking if pending limit for referrer has been reached
     *
     * @return bool
     */
    private function isLessThenMinWithdrawReferrer(): bool
    {
        return ($this->referrer->pending_amount + $this->params['referrerProfit']) < Wallet::MIN_BITCOIN_WITHDRAWAL;
    }

    /**
     * Create income
     * Create referrer income if exists
     *
     * @param Wallet|null $wallet
     * @return void
     */
    public function createIncome(?Wallet $wallet): void
    {
        $income = IncomeCreate::execute(
            incomeCreateData: $this->buildMiningTypeDto($wallet)
        );

        if ($this->referrer) {

            $referrerSub = $this->referrer->subs->first();

            $referralIncome = IncomeCreate::execute(
                incomeCreateData: IncomeCreateData::fromRequest([
                    'group_id' => $referrerSub->group_id,
                    'wallet_id' => $referrerSub->wallets->first()?->id,
                    'dailyAmount' => $this->params['referrerProfit'],
                    'type' => Type::REFERRAL,
                    'status' => $this->params['status'],
                    'message' => $this->params['message'],
                    'hash' => $this->params['hash'],
                    'diff' => $this->params['diff'],
                ])
            );

            Log::channel('incomes')
                ->info(
                    message: "REFERRAL INCOME CREATE FROM {$this->sub->sub} to {$referrerSub->sub}",
                    context: $referralIncome->toArray()
                );
        }

        Log::channel('incomes')
            ->info(message: 'INCOME CREATE', context: $income->toArray());
    }

    /**
     * Update local sub-account
     * Update local referrer sub-account if exists
     *
     * @return void
     */
    public function updateLocalSub(): void
    {
        Update::execute(
            subData: SubData::fromRequest([
                'user_id' => $this->sub->user_id,
                'group_id' => $this->sub->group_id,
                'sub_name' => $this->sub->sub,
                'pending_amount' => $this->params['pendingAmount'],
                'total_amount' => $this->params['totalAmount'],
            ]),
            sub: $this->sub
        );

        if ($this->referrer) {

            $referrerFirstSub = $this->referrer->subs->first();

            Update::execute(
                subData: SubData::fromRequest([
                    'user_id' => $this->referrer->id,
                    'group_id' => $referrerFirstSub->group_id,
                    'sub_name' => $referrerFirstSub->sub,
                    'pending_amount' => $referrerFirstSub->pending_amount + $this->params['referrerProfit'],
                    'total_amount' => $referrerFirstSub->total_amount + $this->params['referrerProfit'],
                ]),
                sub: $referrerFirstSub
            );
        }
    }

    /**
     * Create finance record
     *
     * @return void
     */
    public function createFinance(): void
    {
        Create::execute(financeData: FinanceData::fromRequest([
            'group_id' => $this->sub->group_id,
            'earn' => $this->dailyEarn,
            'user_total' => $this->params['dailyAmount'],
            'percent' => $this->sub->percent,
            'profit' => $this->dailyEarn * (($this->sub->percent + BtcComService::FEE) / 100),
        ]));
    }

    private function buildMiningTypeDto(?Wallet $wallet): IncomeCreateData
    {
        return IncomeCreateData::fromRequest([
            'group_id' => $this->sub->group_id,
            'wallet_id' => $wallet?->id,
            'dailyAmount' => $this->params['dailyAmount'],
            'type' => Type::MINING,
            'status' => $this->params['status'],
            'message' => $this->params['message'],
            'hashrate' => $this->params['hash'],
            'difficulty' => $this->params['diff'],
        ]);
    }

    private function buildReferralTypeDto()
    {

    }
}
