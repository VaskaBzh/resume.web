<?php

declare(strict_types=1);

namespace App\Services\Internal\Income\Types;

use App\Dto\DtoContract;
use App\Dto\Income\IncomeCreateData;
use App\Enums\Income\Status;
use App\Enums\Income\Type;
use App\Services\Internal\Income\BaseIncome;
use App\Utils\Earn;
use App\Utils\HashRateConverter;

class MiningIncome extends BaseIncome
{
    protected function setAmount(): static
    {
        $this->amount = Earn::calculateBitcoin(
            hashRate: $this->sub->hash_rate,
            fee: config('api.btc.fee') + $this->fee
        );

        return $this;
    }

    protected function buildDto(): static
    {
        $this->dto = IncomeCreateData::fromArray([
            'sub' => $this->sub,
            'wallet' => $this->sub->wallets()->first(),
            'dailyAmount' => $this->amount,
            'type' => Type::MINING,
            'status' => Status::onSub($this->sub, $this->amount),
            'hash' => HashRateConverter::fromPure($this->sub->hash_rate),
        ]);

        return $this;
    }

    public function dto(): DtoContract
    {
        return $this->dto;
    }
}
