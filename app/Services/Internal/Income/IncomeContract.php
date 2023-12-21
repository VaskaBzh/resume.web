<?php

declare(strict_types=1);

namespace App\Services\Internal\Income;

use App\Dto\DtoContract;

interface IncomeContract
{
    public function getAmount(): float;

    public function setEarn(): static;

    public function setAmount(): static;

    public function setFee(): static;

    public function dto(): DtoContract;
}
