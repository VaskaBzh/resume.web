<?php

declare(strict_types=1);

namespace App\Dto;

use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Models\Wallet;
use Illuminate\Support\Arr;

readonly class IncomeData
{
    /**
     * @param int $groupId - id сабаккаунта
     * @param string|null $txid - id транзакции при выводе сердств с кошелька allbtc на внешний сервис
     * @param string|null $wallet - адрес кошелька
     * @param float $dailyAmount - доход пользователя за сутки
     * @param string $unit - единиица измерения
     * @param string $status - статус транзакции
     * @param string|null $message - сообщение транзакции
     * @param float $hashrate - хэщрейт
     * @param int $difficulty - сложность сети
     */
    public function __construct(
        public int $groupId,
        public ?string $txid,
        public ?string $wallet,
        public float $dailyAmount,
        public string $unit,
        public string $status,
        public string $message,
        public float $hashrate,
        public int $difficulty,

    ){}

    public static function fromRequest(array $requestData): IncomeData
    {
        return new self(
            groupId: $requestData['group_id'],
            txid: Arr::get($requestData,'txid'),
            wallet: $requestData['wallet'],
            dailyAmount: $requestData['dailyAmount'],
            unit: Arr::get($requestData, 'unit', 'T'),
            status: Arr::get($requestData, 'status', Status::REJECTED->value),
            message: Arr::get($requestData, 'message', Message::NO_WALLET->value),
            hashrate: $requestData['hash'],
            difficulty: $requestData['diff'],
        );
    }
}
