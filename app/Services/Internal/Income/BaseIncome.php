<?php

declare(strict_types=1);

namespace App\Services\Internal\Income;

use App\Dto\DtoContract;
use App\Exceptions\CalculatingException;
use App\Models\Sub;

abstract class BaseIncome implements IncomeContract
{
    protected float $fee;

    protected float $earn;

    protected float $amount;

    /**
     * @param Sub $sub
     * @throws CalculatingException
     */
    protected function __construct(protected Sub $sub)
    {
        $this->setFee()
            ->setEarn()
            ->setAmount();
    }

    /**
     * @throws CalculatingException
     */
    public static function make(Sub $sub): static
    {
        return new static($sub);
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    abstract public function setFee(): static;

    /**
     * @throws CalculatingException
     */
    abstract public function setEarn(): static;

    /**
     * @throws CalculatingException
     */
    abstract public function setAmount(): static;

    abstract public function dto(): DtoContract;
}
