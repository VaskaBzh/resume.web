<?php

declare(strict_types=1);

namespace App\Dto\Income;

use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Enums\Income\Type;
use Illuminate\Support\Arr;

readonly final class IncomeCreateData
{
    /**
     * @param int $groupId - id сабаккаунта
     * @param float $dailyAmount - доход пользователя за сутки
     * @param Type $type - тип начисления
     * @param ?int $referralId - id рефовода
     * @param Status $status - статус транзакции
     * @param Message $message - сообщение транзакции
     * @param float $hashrate - хэщрейт
     * @param int $difficulty - сложность сети
     */
    public function __construct(
        public int     $groupId,
        public float   $dailyAmount,
        public Type    $type,
        public ?int     $referralId,
        public Status  $status,
        public Message $message,
        public float   $hashrate,
        public int     $difficulty,
    ){}

    public static function fromRequest(array $requestData): IncomeCreateData
    {
        return new self(
            groupId: $requestData['group_id'],
            dailyAmount: $requestData['dailyAmount'],
            type: $requestData['type'],
            referralId: $requestData['referral_id'],
            status: $requestData['status'],
            message: $requestData['message'],
            hashrate: $requestData['hash'],
            difficulty: $requestData['diff'],
        );
    }
}
