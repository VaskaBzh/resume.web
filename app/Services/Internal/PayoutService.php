<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\Payout\Create;
use App\Dto\Income\UpdateStatusData;
use App\Dto\PayoutData;
use App\Enums\Income\Status;
use App\Exceptions\PayOutException;
use App\Models\Payout;
use App\Models\Sub;
use App\Models\Wallet;
use App\Services\External\Wallet\Client;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final readonly class PayoutService
{
    public function init(): void
    {
        Sub::readyToPayout()
            ->with('wallets')
            ->get()
            ->each(function (Sub $sub) {
                try {
                    DB::beginTransaction();

                    $this->localSubProcess(sub: $sub, txId: $this->withdraw($sub));

                    DB::commit();
                } catch (PayOutException|\Exception $e) {
                    DB::rollBack();

                    $this->handlePayoutException($sub, $e);

                    return;
                }
            });
    }

    private function localSubProcess(Sub $sub, string $txId): void
    {
        $payout = $this->createLocalPayout($sub, $txId);

        SubService::resetPending(sub: $sub);
        IncomeService::updateIncomes(data: UpdateStatusData::fromArray([
            'sub' => $sub,
            'payout' => $payout,
            'status' => Status::COMPLETED,
        ]));

        Log::channel('commands.payouts')
            ->info(message: 'PAYOUT CREATED', context: $payout->toArray());
    }

    /**
     * Create local payout
     */
    private function createLocalPayout(Sub $sub, string $txId): Payout
    {
        return Create::execute(PayoutData::fromArray([
            'sub' => $sub,
            'wallet' => $sub->wallets->first(),
            'payout' => (float) $sub->pending_amount,
            'txid' => $txId,
        ]));
    }

    /**
     * Withdraw sub-account balance to remote wallet service
     *
     * @throws PayOutException
     * @throws RequestException
     */
    private function withdraw(Sub $sub): ?string
    {
        $client = app(Client::class);
        $client->unlock();
        $txId = $client->sendBalance(
            wallet: $sub->wallets->first()->wallet,
            balance: (float) $sub->pending_amount,
        );
        $client->lock();

        return $txId;
    }

    private function handlePayoutException(Sub $sub, $e): void
    {
        IncomeService::updateIncomes(data: UpdateStatusData::fromArray([
            'sub' => $sub,
            'status' => Status::ERROR,
        ]));

        report($e);
    }
}
