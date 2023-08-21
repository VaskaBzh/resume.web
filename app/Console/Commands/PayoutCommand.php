<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Events\PayoutCompleteEvent;
use App\Models\Sub;
use App\Models\Wallet;
use App\Services\External\WalletService;
use App\Services\Internal\IncomeService;
use App\Services\Internal\PayoutService;
use Illuminate\Console\Command;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Log;

class PayoutCommand extends Command
{
    protected $signature = 'payout';

    protected $description = 'Вывод средств на сервис кошелька';

    public function handle(): void
    {
        $readyToPayoutSubs = Sub::readyToPayout()->with('wallets')->get();

        if (!filled($readyToPayoutSubs)) {
            return;
        }

        $readyToPayoutSubs->each(static function (Sub $sub) {
            self::process(
                payoutService: resolve(PayoutService::class),
                sub: $sub
            );
        });
    }

    public static function process(
        PayoutService $payoutService,
        Sub           $sub
    ): void
    {
        $payoutService->init(sub: $sub);
        $payoutService->unlockRemoteWallet();
        $txId = $payoutService->payOut();

        if (!$txId) {
            Log::channel('incomes')->info('TXID IS EMPTY', [
                'sub' => $sub->group_id,
            ]);

            $payoutService->setMessage(Message::ERROR_PAYOUT->value);
            $payoutService->complete();

            return;
        }

        $payoutService
            ->setStatus(Status::COMPLETED->value)
            ->setMessage(Message::COMPLETED->value)
            ->setTxId(txId: $txId);


        $payoutService->createPayout();
        $payoutService->clearPendingAmount();
        $payoutService->complete();
        $payoutService->lock();
    }
}
