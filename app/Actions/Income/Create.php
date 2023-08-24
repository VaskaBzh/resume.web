<?php

declare(strict_types=1);

namespace App\Actions\Income;

use App\Dto\Income\IncomeCreateData;
use App\Models\Income;

class Create
{
    public static function execute(IncomeCreateData $incomeCreateData): Income
    {
        return Income::create([
            'group_id' => $incomeCreateData->groupId,
            'wallet_id' => $incomeCreateData->walletId,
            'referral_id' => $incomeCreateData->referralId,
            'daily_amount' => $incomeCreateData->dailyAmount,
            'status' => $incomeCreateData->status,
            'message' => $incomeCreateData->message,
            'hash' => $incomeCreateData->hashrate,
            'diff' => $incomeCreateData->difficulty,
        ]);
    }
}
