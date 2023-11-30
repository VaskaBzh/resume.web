<?php

declare(strict_types=1);

namespace App\Dto\Sub;

use Illuminate\Support\Arr;

final readonly class SubUpsertData
{
    /**
     * @param  int  $userId - id пользователя allbtc.com
     * @param  int  $groupId - id сабаккаунта
     * @param  string  $subName - имя сабаккаунта
     * @param  float|null  $pendingAmount - доход не превысивший допстимый порог вывода средств и удержанный на балансе
     * @param  float|null  $totalAmount - сумма добычи за все время
     */
    public function __construct(
        public int $userId,
        public int $groupId,
        public string $subName,
        public ?float $pendingAmount,
        public ?float $totalAmount,
    ) {
    }

    public static function fromRequest(array $requestData): SubUpsertData
    {
        return new self(
            userId: $requestData['user_id'],
            groupId: $requestData['group_id'],
            subName: $requestData['sub_name'],
            pendingAmount: Arr::get($requestData, 'pending_amount', 0),
            totalAmount: Arr::get($requestData, 'total_amount', 0),
        );
    }
}
