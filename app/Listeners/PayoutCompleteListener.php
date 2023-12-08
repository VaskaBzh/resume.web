<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Actions\Payout\Create;
use Illuminate\Support\Facades\Log;

final readonly class PayoutCompleteListener
{
    public function handle($event): void
    {
        $payout = Create::execute(payoutData: $event->data);

        Log::channel('payouts')->info('PAYOUT COMPLETE', [
            'sub_name' => $event->data->sub->sub,
            'group_id' => $payout->group_id,
            'payout_id' => $payout->id,
        ]);
    }
}
