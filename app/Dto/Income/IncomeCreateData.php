<?php

declare(strict_types=1);

namespace App\Dto\Income;

use App\Enums\Income\Message;
use App\Enums\Income\Status;
use Illuminate\Support\Arr;

readonly final class IncomeCreateData
{
    /**
     * @param int $groupId - id сабаккаунта
     * @param int|null $walletId - кошелек
     * @param int|null $referralId - айди реферальной программы (хранение связи реферала с овнером)
     * @param float $dailyAmount - доход пользователя за сутки
     * @param string $status - статус транзакции
     * @param string $message - сообщение транзакции
     * @param float $hashrate - хэщрейт
     * @param int $difficulty - сложность сети
     */
    public function __construct(
        public int $groupId,
        public ?int $walletId,
        public ?int $referralId,
        public float $dailyAmount,
        public string $status,
        public string $message,
        public float $hashrate,
        public int $difficulty,

    ){}

    public static function fromRequest(array $requestData): IncomeCreateData
    {
        return new self(
            groupId: $requestData['group_id'],
            walletId: $requestData['wallet_id'],
            referralId: Arr::get($requestData, 'referral_id'),
            dailyAmount: $requestData['dailyAmount'],
            status: Arr::get($requestData, 'status', Status::REJECTED->value),
            message: Arr::get($requestData, 'message', Message::NO_WALLET->value),
            hashrate: $requestData['hash'],
            difficulty: $requestData['diff'],
        );
    }
}