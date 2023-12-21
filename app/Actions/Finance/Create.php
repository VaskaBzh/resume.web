<?php

declare(strict_types=1);

namespace App\Actions\Finance;

use App\Actions\Executable;
use App\Dto\DtoContract;
use App\Models\Finance;

class Create implements Executable
{
    public static function execute(DtoContract $financeData): void
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
