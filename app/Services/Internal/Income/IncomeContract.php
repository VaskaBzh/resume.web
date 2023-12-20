<?php

declare(strict_types=1);

namespace App\Services\Internal\Income;

use App\Models\Income;

interface IncomeContract
{
    public function setEarn(): static;

    public function setAmount(): static;

    public function setFee(): static;

    public function store(): Income;
}
