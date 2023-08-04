<?php

declare(strict_types=1);

namespace App\Dto;

readonly class PayoutData
{
    /**
     *
     * @param string $txId - id транзакции при выводе сердств с кошелька allbtc на внешний сервис
     */
    public function __construct(
        public int $groupId,
        public int $walletId,
        public float $payout,
        public string $txId,
    )
    {}

    public static function fromRequest(array $requestData): PayoutData
    {
        return new self(
            groupId: $requestData['group_id'],
            walletId: $requestData['wallet_id'],
            payout: $requestData['payout'],
            txId: $requestData['txid'],
        );
    }
}
