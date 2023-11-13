<?php

declare(strict_types=1);

namespace App\Actions\Income;

use App\Dto\Income\IncomeCreateData;
use App\Models\Income;

class Create
{
    public static function execute(IncomeCreateData $incomeCreateData): Income
    {
        /**
         * @var Income
         */
        return Income::create([
            'group_id' => $incomeCreateData->groupId,
            'type' => $incomeCreateData->type->value,
            'referral_id' => $incomeCreateData->referralId,
            'daily_amount' => $incomeCreateData->dailyAmount,
            'status' => $incomeCreateData->status->value,
            'message' => $incomeCreateData->message->value,
            'hash' => $incomeCreateData->hashrate,
            'diff' => $incomeCreateData->difficulty,
        ]);
    }
}
