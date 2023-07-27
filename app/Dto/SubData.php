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
     * @param float|null $payments - сумма вывода средств за все время со всех кошельков
     * @param float|null $unPayments - доход не превысивший допстимый порог вывода средств
     * @param float|null $accruals - сумма начисления средств за все время со всех кошельков
     */
    public function __construct(
        public int $userId,
        public int $groupId,
        public string $groupName,
        public ?float $payments,
        public ?float $unPayments,
        public ?float $accruals,
    )
    {
    }

    public static function fromRequest(array $requestData): SubData
    {
        return new self(
            userId: $requestData['user_id'],
            groupId: $requestData['group_id'],
            groupName: $requestData['group_name'],
            payments: Arr::get($requestData, 'payments'),
            unPayments: Arr::get($requestData, 'unPayments'),
            accruals: Arr::get($requestData, 'accruals')
        );
    }
}
