<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\Income\Complete;
use App\Actions\Sub\Update;
use App\Dto\Income\CompleteData;
use App\Dto\Sub\SubUpsertData;
use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Events\PayOutEvent;
use App\Models\Income;
use App\Models\Sub;
use App\Models\Wallet;
use App\Services\External\WalletService;
use Illuminate\Support\Facades\Log;

final class PayoutService
{
    /**
     * Local sub-account
     */
    private Sub $sub;

    /**
     * Local sub-account wallet
     */
    public readonly ?Wallet $wallet;

    /**
     * @var array{status: Status::*, message: Message::*, txid?: string}
     *
     * status @type Status enum Income status
     *
     *           @example Status::REJECTED->value
     *
     * message @type Message enum Income status message, enum Message.
     *           @example Message::ERROR_PAYOUT->value
     *
     * txid @type ?string Transaction id return from remote wallet
     */
    private array $params = [
        'status' => Status::REJECTED->value,
        'message' => Message::ERROR_PAYOUT->value,
    ];

    /**
     * Remote wallet service
     */
    private readonly WalletService $remoteWallet;

    public function init(Sub $sub): void
    {
        $this->sub = $sub;
        $this->wallet = $sub->wallets()->first();
        $this->remoteWallet = resolve(WalletService::class);
    }

    /**
     * Set income message
     */
    public function setMessage(Message $message): PayoutService
    {
        $this->params['message'] = $message->value;

        return $this;
    }

    /**
     * Set income status status
     */
    public function setStatus(Status $status): PayoutService
    {
        $this->params['status'] = $status->value;

        return $this;
    }

    /**
     * Set transaction id
     */
    public function setTxId(string $txId): PayoutService
    {
        $this->params['txid'] = $txId;

        return $this;
    }

    /**
     * Unlock remote wallet
     */
    public function unlockRemoteWallet(): void
    {
        try {
            $this->remoteWallet->unlock();

            Log::channel('payouts')->info('WALLET UNLOCKED', [
                'sub' => $this->sub->id,
            ]);

        } catch (\Exception $e) {
            report($e);
        }
    }

    /**
     * Withdraw sub-account balance from remote wallet to sub-account wallet
     */
    public function payOut(): ?string
    {
        event(new PayOutEvent(sub: $this->sub));
        return $this
            ->remoteWallet
            ->sendBalance(
                wallet: $this->wallet,
                balance: (float) $this->sub->pending_amount
            );
    }

    /**
     * Reset sub-account pending amount
     */
    public function clearPendingAmount(): PayoutService
    {
        Update::execute(
            subData: SubUpsertData::fromRequest([
                'user_id' => $this->sub->user_id,
                'group_id' => $this->sub->group_id,
                'sub_name' => $this->sub->sub,
                'pending_amount' => 0,
            ]),
            sub: $this->sub
        );

        return $this;
    }

    /**
     * Change incomes status to completed
     */
    public function updateIncome(): PayoutService
    {
        $incomes = Income::getNotCompleted(
            groupId: $this->sub->group_id
        )->get();

        if ($incomes) {
            Complete::execute(
                incomes: $incomes,
                incomeCompleteData: CompleteData::fromArray([
                    'status' => $this->params['status'],
                    'message' => $this->params['message'],
                    'wallet' => $this->wallet,
                ])
            );

            Log::channel('payouts')->info('INCOMES STATUSES CHANGES', [
                'sub' => $this->sub->sub,
                'wallet' => $this->wallet->id,
                'status' => $this->params['status'],
                'message' => $this->params['message'],
            ]);
        }

        return $this;
    }

    /**
     * Create payout record
     */
    public function createPayout(): PayoutService
    {
        event(new PayOutEvent(
            sub: $this->sub,
            wallet: $this->wallet,
            payout: (float) $this->sub->pending_amount,
            txId: $this->params['txid'],
        ));

        return $this;
    }

    /**
     * Lock remote wallet
     */
    public function lock(): void
    {
        $this->remoteWallet->lock();

        Log::channel('payouts')->info('WALLET LOCKED', [
            'sub' => $this->sub->id,
        ]);
    }

    /**
     * Check if local waller is exists and unblocked
     */
    public function canTransaction(): bool
    {
        if (is_null($this->wallet?->wallet)) {
            $this->setMessage(Message::NO_WALLET);

            return false;
        }

        if (! $this->wallet->isUnlocked()) {
            $this->setMessage(Message::ON_VERIFY);

            return false;
        }

        return true;
    }
}
