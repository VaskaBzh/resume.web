<?php

declare(strict_types=1);

namespace App\Actions\Finance;

use App\Dto\FinanceData;
use App\Models\Finance;

class Create
{
    public static function execute(FinanceData $financeData): void
    {
        Finance::create([
            'group_id' => $financeData->groupId,
            'earn' => $financeData->earn,
            'user_total' => $financeData->userTotal,
            'percent' => $financeData->percent,
            'clear_percent' => $financeData->clear_percent,
            'profit' => $financeData->profit,
        ]);
    }
}
