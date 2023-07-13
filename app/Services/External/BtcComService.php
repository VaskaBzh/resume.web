<?php

declare(strict_types=1);

namespace App\Services\External;

use App\Dto\User\UserData;
use GuzzleHttp\Client;

class BtcComService
{
    /**
     * Проверка на существование пользователя на стороне btc.com
     */
    public function btcHasUser($data): bool
    {
        /* Убираем первые две группы ("Все группы", "Разгруппировано")
         * Проверяем наличие имени в группах
        */
        return collect($data['data']['list'])
            ->filter(static fn(array $groups, int $index) => $index > 1)
            ->pluck('name')
            ->contains('MyWorker');
    }
}
