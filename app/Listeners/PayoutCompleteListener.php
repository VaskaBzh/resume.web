<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Actions\Payout\Create;
use App\Dto\PayoutData;
use Illuminate\Support\Facades\Log;

class PayoutCompleteListener
{
    public function handle($event): void
    {
        $payout = Create::execute(payoutData: PayoutData::fromRequest([
            'group_id' => $event->sub->group_id,
            'wallet_id' => $event->wallet->id,
            'payout' => $event->payout,
            'txid' => $event->txId,
        ]));

        Log::channel('payouts')->info('PAYOUT COMPLETE', [
            'sub_name' => $event->sub->sub,
            'group_id' => $event->sub->group_id,
            'payout_id' => $payout->id,
        ]);
    }
}
