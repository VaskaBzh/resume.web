<?php

declare(strict_types=1);

namespace App\Services\Internal\Income\Types;

use App\Dto\DtoContract;
use App\Dto\Income\IncomeCreateData;
use App\Enums\Income\Status;
use App\Enums\Income\Type;
use App\Models\Sub;
use App\Services\Internal\Income\BaseIncome;
use App\Utils\HashRateConverter;

class ReferralIncome extends BaseIncome
{
    private Sub $referrerActiveSub;

    protected function init(): static
    {
        $referrerActiveSub = $this->sub->user->referrer->activeSub()?->first();

        $this->withReferrerActiveSub($referrerActiveSub);

        return $this;
    }

    protected function setAmount(): static
    {
        $user = $this->sub->user;

        $referralPercent = (float) $user->referral_percent ?? $this->referrerActiveSub->user->referral_percent;

        $this->amount = $this->earn * ($referralPercent / 100);

        return $this;
    }

    protected function setDto(): static
    {
        $this->dto = IncomeCreateData::fromArray([
            'sub' => $this->referrerActiveSub,
            'wallet' => $this->referrerActiveSub->wallets()->first(),
            'referral_id' => $this->sub->user->id,
            'dailyAmount' => $this->amount,
            'type' => Type::REFERRAL,
            'status' => Status::onSub($this->referrerActiveSub, $this->amount),
            'hash' => HashRateConverter::fromPure($this->sub->hash_rate),
        ]);

        return $this;
    }

    public function dto(): DtoContract
    {
        return $this->dto;
    }

    protected function withReferrerActiveSub(Sub $referrerActiveSub): static
    {
        $this->referrerActiveSub = $referrerActiveSub;

        return $this;
    }
}
