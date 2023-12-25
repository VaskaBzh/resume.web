<?php

declare(strict_types=1);

namespace App\Services\Internal\Income;

use App\Dto\DtoContract;
use App\Exceptions\CalculatingException;
use App\Models\Sub;
use App\Utils\Earn;
use App\Utils\Fee;

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
            ->buildDto();
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

    protected function setEarn(): static
    {
        $this->earn = Earn::calculateBitcoin(hashRate: $this->sub->hash_rate);

        return $this;
    }

    /**
     * @throws CalculatingException
     */
    protected function setFee(): static
    {
        $this->fee = Fee::get($this->sub);

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

    abstract protected function buildDto(): static;

    abstract protected function setAmount(): static;

    abstract public function dto(): DtoContract;
}
