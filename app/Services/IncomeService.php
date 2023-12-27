<?php

declare(strict_types=1);

namespace App\Services;

use App\Actions\Finance\Create;
use App\Actions\Income\Create as IncomeCreate;
use App\Actions\Income\UpdateStatus;
use App\Actions\Sub\Update;
use App\Dto\FinanceData;
use App\Dto\Income\IncomeCreateData;
use App\Dto\Income\UpdateStatusData;
use App\Dto\Sub\SubUpsertData;
use App\Enums\Income\Status;
use App\Enums\Income\Type;
use App\Exceptions\CalculatingException;
use App\Models\MinerStat;
use App\Models\Sub;
use App\Services\App\Helper;
use App\Utils\HashRateConverter;
use Illuminate\Support\Facades\Log;

final class IncomeService
{

    /**
     * @var array{
     *     mining: array{
     *         dailyAmount: float,
     *         pendingAmount: float,
     *         totalAmount: float,
     *         status: string,
     *         message?: string
     *     },
     *     referral: array{
     *         dailyAmount: float,
     *         pendingAmount: float,
     *         totalAmount: float,
     *         status: string,
     *         message?: string,
     *     },
     *     hash: float|null,
     *     diff: float|null
     * } $params
     *
     * Params:
     * 'mining': Common mining income params.
     *   'dailyAmount': Daily earn after deducting the commission of allbtc and remote pool
     *   'pendingAmount': Sub-account amount until withdrawal limit
     *   'totalAmount': Sub-account total amount for all time
     * 'referral': Referral income params.
     *   'dailyAmount': Referrer profit from this referral
     *   'pendingAmount': Referrer amount until withdrawal limit
     *   'totalAmount': Referrer total amount
     * 'hash': Sub-account hash rate
     * 'diff': Current network difficulty
     */
    private array $params = [
        'mining' => [],
        'referral' => [],
        'hash' => null,
        'diff' => null,
    ];

    /**
     * @param MinerStat $stat Global mining stats (net difficulty, reward block, etc)
     * @param Sub $sub Local sub-account
     * @param Sub|null $referrerSub Referrer sub-account
     * @param float $referralPercent Referral percent
     * @param float $dailyEarn Pure sub-account coin earning
     * @param float $fee AllBtc commission
     */
    private function __construct(
        private readonly MinerStat $stat,
        private readonly Sub       $sub,
        private readonly ?Sub      $referrerSub,
        private readonly float     $referralPercent,
        private readonly float     $dailyEarn,
        private readonly int       $hashRate,
        private readonly float     $fee,
    )
    {
    }

    /**
     * Init service
     */
    public static function init(
        MinerStat $stat,
        Sub       $sub,
        ?Sub      $referrerSub
    ): IncomeService
    {
        $service = new self(
            stat: $stat,
            sub: $sub,
            referrerSub: $referrerSub,
            referralPercent: (float)$sub->user->referral_percent ?? $referrerSub->user->referral_percent,
            dailyEarn: Helper::calculateEarn(
                hashRate: $subAccountHashRate = $sub->hash_rate,
            ),
            hashRate: $subAccountHashRate,
            fee: $sub->allbtc_fee - (float)$sub->user->referral_discount
        );

        $service->setParams();

        return $service;
    }

    /**
     * Set sub-account params
     */
    private function setParams(): void
    {
        $this
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
     * Set the daily earn after deducting the commission of allbtc and remote pool
     *
     * @throws CalculatingException
     */
    private function setDailyAmount(): IncomeService
    {
        $this->params[Type::MINING->value]['dailyAmount'] = Helper::calculateEarn(
            hashRate: $this->hashRate,
            fee: config('api.btc.fee') + $this->fee
        );

        return $this;
    }

    /**
     * Set sub-account daily amount until withdrawal limit
     */
    public function setPendingAmount(Sub $sub, Type $incomeType): IncomeService
    {
        $this->params[$incomeType->value]['pendingAmount'] = $this->params[$incomeType->value]['dailyAmount'] +
            (float)$sub->pending_amount;

        return $this;
    }

    /**
     * Set sub-account total amount for all time
     */
    public function setTotalAmount(Sub $sub, Type $incomeType): IncomeService
    {
        $this->params[$incomeType->value]['totalAmount'] = $this->params[$incomeType->value]['dailyAmount'] +
            $sub->total_amount;

        return $this;
    }

    /**
     * Set referrer profit
     */
    public function setReferrerProfit(): IncomeService
    {
        $this->params[Type::REFERRAL->value]['dailyAmount'] = $this->dailyEarn *
            ($this->referralPercent / 100);

        return $this;
    }

    /**
     * Checking if pending limit has been reached
     */
    public function isReadyToPayOut(Sub $sub, Type $incomeType): bool
    {
        $dailyAmount = $this->params[$incomeType->value]['dailyAmount'];

        return ((float)$sub->pending_amount + $dailyAmount) >= config('api.wallet.min_withdrawal');
    }

    /**
     * Set income message and status
     */
    public function setInfo(
        Sub  $sub,
        Type $incomeType
    ): void
    {
        if ($sub->wallets->isEmpty()) {
            $this->params[$incomeType->value]['status'] = Status::NO_WALLET;

            return;
        }

        if (!$sub->wallets->first()->isUnlocked()) {
            $this->params[$incomeType->value]['status'] = Status::ON_VERIFY;

            return;
        }

        if (!$this->isReadyToPayOut($sub, $incomeType)) {
            $this->params[$incomeType->value]['status'] = Status::PENDING;

            return;
        }

        $this->params[$incomeType->value]['status'] = Status::READY_TO_PAYOUT;
    }

    /**
     * Create income
     * Create referrer income if exists
     */
    public function createIncome(Sub $sub, Type $incomeType): void
    {
        $income = IncomeCreate::execute(
            incomeCreateData: IncomeCreateData::fromRequest([
                'sub' => $sub,
                'dailyAmount' => $this->params[$incomeType->value]['dailyAmount'],
                'type' => $incomeType,
                'referral_id' => $incomeType->value === 'referral' ? $this->sub->user->id : null,
                'status' => $this->params[$incomeType->value]['status'],
                'hash' => HashRateConverter::fromPure($this->hashRate),
                'diff' => $this->stat->network_difficulty,
            ])
        );

        Log::channel('commands.incomes')->info(
            message: sprintf('INCOME CREATED. TYPE: %s', $incomeType->value),
            context: $income?->toArray()
        );
    }

    public static function updateIncomes(UpdateStatusData $data): void
    {
        UpdateStatus::execute(updateStatusData: $data);
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
        try {
            if ($this->sub->user->referrer_id == null) {
                $clear_percent = $this->fee;
            } else {
                if ($this->fee < $this->sub->user->referral_percent) {
                    Log::channel('commands.incomes')->warning('Referal percent more then our percent!');
                }
                $clear_percent = $this->fee - $this->sub->user->referral_percent - $this->sub->user->referral_discount;
            }

            Create::execute(financeData: FinanceData::fromRequest([
                'group_id' => $this->sub->group_id,
                'earn' => $this->dailyEarn - $this->dailyEarn * (config('api.btc.fee') / 100),
                'user_total' => $this->params[Type::MINING->value]['dailyAmount'],
                'percent' => $this->fee,
                'clear_percent' => $clear_percent,
                'profit' => $this->dailyEarn * ($clear_percent / 100),
            ]));
        } catch (\Exception $e) {
            Log::error('Exception occurred while creating finance: ' . $e->getMessage());
        }
    }
}
