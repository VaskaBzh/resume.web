<?php

declare(strict_types=1);

namespace App\Services\Income;

use App\Dto\DtoContract;

interface IncomeContract
{
    public function getAmount(): float;

    public function getEarn(): float;

    public function getFee(): float;

    public function dto(): DtoContract;
}
