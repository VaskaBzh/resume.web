<?php

declare(strict_types=1);

namespace App\Console\Commands\Income;

use App\Dto\Income\UpdateStatusData;
use App\Enums\Income\Status;
use App\Exceptions\PayOutException;
use App\Models\Sub;
use App\Services\External\Wallet\Client;
use App\Services\Internal\IncomeService;
use App\Services\Internal\PayoutService;
use App\Services\Internal\SubService;
use Illuminate\Console\Command;

class PayoutCommand extends Command
{
    protected $signature = 'payout';

    protected $description = 'Вывод средств на сервис кошелька';

    public function handle(): void
    {
        Sub::readyToPayout()
            ->with('wallets')
            ->get()
            ->each(static function (Sub $sub) {
                try {
                    $payout = PayoutService::init($sub)
                        ->payOut(static function (Client $client) use ($sub) {
                            $amount = (float) $sub->pending_amount;

                            $client->unlock();
                            $txId = $client->sendBalance(
                                wallet: $sub->wallets->first()->wallet,
                                balance: $amount,
                            );
                            $client->lock();

                            return [$txId, $amount];
                        });

                    SubService::resetPending(sub: $sub);
                    IncomeService::updateIncomes(data: UpdateStatusData::fromArray([
                        'sub' => $sub,
                        'payout' => $payout,
                        'status' => Status::COMPLETED,
                    ]));
                } catch (PayOutException|\Exception $e) {
                    IncomeService::updateIncomes(data: UpdateStatusData::fromArray([
                        'sub' => $sub,
                        'status' => Status::ERROR,
                    ]));

                    report($e);

                    return;
                }
            });
    }
}
