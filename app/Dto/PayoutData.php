<?php

declare(strict_types=1);

namespace App\Dto;

use App\Models\Sub;
use App\Models\Wallet;

final readonly class PayoutData
{
    /**
     * @param  Wallet  $wallet Sub-account local wallet
     * @param  float  $payout Payout amount
     * @param  string  $txId Transaction id
     */
    public function __construct(
        public Sub $sub,
        public Wallet $wallet,
        public float $payout,
        public string $txId,
    ) {
    }

    public static function fromArray(array $data): PayoutData
    {
        return new self(
            sub: $data['sub'],
            wallet: $data['wallet'],
            payout: $data['payout'],
            txId: $data['txid'],
        );
    }
}
