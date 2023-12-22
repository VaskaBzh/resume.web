<?php

declare(strict_types=1);

namespace App\Services\Internal\Income;

use App\Dto\DtoContract;
use App\Exceptions\CalculatingException;
use App\Models\Sub;
use App\Utils\Helper;

abstract class BaseIncome implements IncomeContract
{
    protected float $fee;

    protected float $earn;

    protected float $amount;

    protected DtoContract $dto;

    /**
     * @throws CalculatingException
     */
    private function __construct(protected Sub $sub)
    {
        $this
            ->init()
            ->setEarn()
            ->setFee()
            ->setAmount()
            ->setDto();
    }

    /**
     * @throws CalculatingException
     */
    public static function make(Sub $sub): static
    {
        return new static($sub);
    }

    protected function init(): static
    {
        return $this;
    }

    /**
     * @throws CalculatingException
     */
    protected function setEarn(): static
    {
        $this->earn = Helper::calculateEarn(hashRate: $this->sub->hash_rate);

        return $this;
    }

    /**
     * @throws CalculatingException
     */
    protected function setFee(): static
    {
        $this->fee = $this->sub->allbtc_fee - (float) $this->sub->user->referral_discount;

        if ($this->fee < 0) {
            throw new CalculatingException('Fee should not be unsigned');
        }

        return $this;
    }

    public function getEarn(): float
    {
        return $this->earn;
    }

    public function getFee(): float
    {
        return $this->fee;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    abstract protected function setDto(): static;

    abstract protected function setAmount(): static;

    abstract public function dto(): DtoContract;
}
