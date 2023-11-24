<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Actions\Payout\Create;
use App\Dto\PayoutData;
use App\Exceptions\PayOutException;
use App\Services\External\WalletService;
use Illuminate\Support\Facades\Log;

final readonly class PayoutCompleteListener
{
    public function handle($event, WalletService $remoteWallet): void
    {
        $subWallet = $event->sub->wallets->first();

        $txId = $remoteWallet
            ->sendBalance(
                wallet: $subWallet,
                balance: (float) $event->sub->pending_amount
            );

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
