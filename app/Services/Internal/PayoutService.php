<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\Income\Complete;
use App\Actions\Sub\Update;
use App\Dto\Income\IncomeCompleteData;
use App\Dto\SubData;
use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Events\PayoutCompleteEvent;
use App\Models\Income;
use App\Models\Sub;
use App\Models\Wallet;
use App\Services\External\WalletService;
use Illuminate\Support\Facades\Log;

class PayoutService
{
    private Sub $sub;
    public readonly ?Wallet $wallet;
    private array $params = [
        'status' => Status::REJECTED->value,
        'message' => Message::ERROR_PAYOUT->value
    ];
    private readonly WalletService $remoteWallet;

    public function init(Sub $sub): void
    {
        $this->sub = $sub;
        $this->wallet = $sub->wallets()->first();
        $this->remoteWallet = resolve(WalletService::class);
    }

    public function setMessage(string $message): PayoutService
    {
        $this->params['message'] = $message;

        return $this;
    }

    public function setStatus(string $status): PayoutService
    {
        $this->params['status'] = $status;

        return $this;
    }

    public function setTxId(string $txId): PayoutService
    {
        $this->params['txid'] = $txId;

        return $this;
    }

    /**
     * Запрос на открытие удаленного кошелька
     *
     * @return void
     */
    public function unlockRemoteWallet(): void
    {
        try {
            $this->remoteWallet->unlock();

            Log::channel('payouts')->info('WALLET UNLOCKED', [
                'sub' => $this->sub->id
            ]);

        } catch (\Exception $e) {
            report($e);
        }
    }

    /**
     * Вывод средств в удаленный кошелек
     *
     * @return string|null
     */
    public function payOut(): ?string
    {
        if ($this->wallet && now() < $this->sub?->user->email_verified_at->addDay()) {
            return $this
                ->remoteWallet
                ->sendBalance(
                    wallet: $this->sub->wallets()->first(),
                    balance: $this->sub->pending_amount
                );
        }

        return null;
    }

    /**
     * Обнуляем накопленный доход
     *
     * @return void
     */
    public function clearPendingAmount(): PayoutService
    {
        Update::execute(
            subData: SubData::fromRequest([
                'user_id' => $this->sub->user_id,
                'group_id' => $this->sub->group_id,
                'group_name' => $this->sub->sub,
                'pending_amount' => 0,
            ]),
            sub: $this->sub
        );

        return $this;
    }

    /**
     * Меняем статусы и сообщения
     */
    public function complete(): PayoutService
    {
        $incomes = Income::getNotCompleted(
            groupId: $this->sub->group_id
        )->get();

        if ($incomes) {
            Complete::execute(
                incomes: $incomes,
                incomeCompleteData: IncomeCompleteData::fromRequest([
                    'status' => $this->params['status'],
                    'message' => $this->params['message']
                ])
            );

            Log::channel('payouts')->info('INCOMES STATUSES CHANGE TO COMPLETE', [
                'sub' => $this->sub->id,
                'wallet' => $this->wallet->id
            ]);
        }

        return $this;
    }

    public function createPayout(): PayoutService
    {
        event(new PayoutCompleteEvent(
            sub: $this->sub,
            wallet: $this->wallet,
            payout: $this->sub->pending_amount,
            txId: $this->params['txid'],
        ));

        return $this;
    }

    public function lock(): void
    {
        $this->remoteWallet->lock();

        Log::channel('payouts')->info('WALLET LOCKED', [
            'sub' => $this->sub->id,
        ]);
    }
}
