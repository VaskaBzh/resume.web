<?php

declare(strict_types=1);

namespace App\Services\Internal\Income;

use App\Exceptions\CalculatingException;
use App\Models\Income;
use App\Models\Sub;

abstract class BaseIncome implements IncomeContract
{
    protected float $fee;

    protected float $earn;

    protected float $amount;

    protected function __construct(protected Sub $sub)
    {
    }

    public static function make(Sub $sub): static
    {
        return new static($sub);
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

    abstract public function store(): Income;
}
