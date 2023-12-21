<?php

declare(strict_types=1);

namespace App\Services\Internal\Income;

use App\Dto\DtoContract;
use App\Dto\Income\IncomeCreateData;
use App\Enums\Income\Status;
use App\Enums\Income\Type;
use App\Exceptions\CalculatingException;
use App\Utils\HashRateConverter;
use App\Utils\Helper;

class MiningIncome extends BaseIncome
{
    public function setFee(): static
    {
        $this->fee = $this->sub->allbtc_fee - (float) $this->sub->user->referral_discount;

        return $this;
    }

    /**
     * @throws CalculatingException
     */
    public function setEarn(): static
    {
        $this->earn = Helper::calculateEarn(hashRate: $this->sub->hash_rate);

        return $this;
    }

    /**
     * @throws CalculatingException
     */
    public function setAmount(): static
    {
        $this->amount = Helper::calculateEarn(
            hashRate: $this->sub->hash_rate,
            fee: config('api.btc.fee') + $this->fee
        );

        return $this;
    }

    public function dto(): DtoContract
    {
        return IncomeCreateData::fromArray([
            'sub' => $this->sub,
            'wallet' => $this->sub->wallets()->first(),
            'dailyAmount' => $this->amount,
            'type' => Type::MINING,
            'status' => Status::onSub($this->sub, $this->amount),
            'hash' => HashRateConverter::fromPure($this->sub->hash_rate),
        ]);
    }
}
