<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Support\Arr;

readonly final class WalletData
{
    /**
     * @param string|null $name - имя кошелшька
     * @param string $walletAddress - адрес кошелька
     * @param int $groupId - id сабаккаунта
     * @param int|null $percent - процент кошелька
     * @param float|null $minWithdrawal - минимальая сумма вывода средств
     * @param float|null $payment - сумма выплаты на кошелек за все время
     */
    public function __construct(
        public ?string $name,
        public string $walletAddress,
        public int $groupId,
        public ?int $percent,
        public ?float $minWithdrawal,
        public ?float $payment,
    )
    {
    }

    public static function fromRequest(array $requestData): WalletData
    {
        return new self(
            name: Arr::get($requestData, 'name'),
            walletAddress: $requestData['wallet'],
            groupId: (int) $requestData['group_id'],
            percent: (int) Arr::get($requestData, 'percent'),
            minWithdrawal: (float) Arr::get($requestData, 'minWithdrawal'),
            payment: Arr::get($requestData, 'payment')
        );
    }
}
