<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\Payout\Create;
use App\Actions\Sub\ResetPending;
use App\Dto\PayoutData;
use App\Exceptions\PayOutException;
use App\Models\Payout;
use App\Models\Sub;
use App\Models\Wallet;
use App\Services\External\Wallet\Client;
use Illuminate\Http\Client\RequestException;

final readonly class PayoutService
{
    /**
     * @param  Sub  $sub Local sub-account
     * @param  Wallet  $wallet Sub-account wallet
     */
    private function __construct(
        private Sub $sub,
        private Wallet $wallet,
    ) {
    }

    public static function init(Sub $sub): PayoutService
    {
        return new self(
            sub: $sub,
            wallet: $sub->wallets->first(),
        );
    }

    /**
     * Withdraw sub-account balance from remote wallet to sub-account wallet
     *
     * @throw
     *
     * @throws PayOutException
     */
    public function payOut(callable $callback): Payout
    {
        try {
            [$txId, $amount] = $callback(app(Client::class));

            return Create::execute(PayoutData::fromArray([
                'sub' => $this->sub,
                'wallet' => $this->wallet,
                'payout' => $amount,
                'txid' => $txId,
            ]));
        } catch (PayOutException|RequestException $e) {
            throw new PayOutException($e->getMessage());
        }
    }
}
