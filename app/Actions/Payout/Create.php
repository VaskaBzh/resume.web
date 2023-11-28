<?php

declare(strict_types=1);

namespace App\Actions\Payout;

use App\Dto\PayoutData;
use App\Models\Payout;

class Create
{
    public static function execute(PayoutData $payoutData): Payout
    {
        return Payout::create([
            'group_id' => $payoutData->sub->group_id,
            'wallet_id' => $payoutData->wallet->id,
            'payout' => $payoutData->payout,
            'txid' => $payoutData->txId,
        ]);
    }
}
