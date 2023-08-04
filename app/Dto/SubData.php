<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Support\Arr;

readonly class SubData
{
    /**
     * @param int $userId - id пользователя allbtc.com
     * @param int $groupId - id сабаккаунта
     * @param string $groupName - имя сабаккаунта
     * @param float|null $totalPayment - сумма вывода средств за все время со всех кошельков
     * @param float|null $accumulateAmount - доход не превысивший допстимый порог вывода средств
     * @param float|null $totalAmount - сумма добычи за все время
     */
    public function __construct(
        public int $userId,
        public int $groupId,
        public string $groupName,
        public ?float $totalPayment,
        public ?float $accumulateAmount,
        public ?float $totalAmount,
    )
    {
    }

    public static function fromRequest(array $requestData): SubData
    {
        return new self(
            userId: $requestData['user_id'],
            groupId: $requestData['group_id'],
            groupName: $requestData['group_name'],
            totalPayment: Arr::get($requestData, 'total_payment'),
            accumulateAmount: Arr::get($requestData, 'accumulated_amount'),
            totalAmount: Arr::get($requestData, 'total_amount')
        );
    }
}
