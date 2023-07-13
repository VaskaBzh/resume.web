<?php

declare(strict_types=1);

namespace App\Services\External;

use App\Dto\User\UserData;
use GuzzleHttp\Client;

class BtcComService
{
    public function __construct(
        private readonly Client $client,
    )
    {
    }

    /**
     * Проверка на существование пользователя на стороне btc.com
     */
    public function btcHasUser($data): bool
    {
        $data = $this->call(
            method: 'get',
            uri: implode('/', [
                config('api.btc'),
                'worker',
                'groups'
            ]) ,
            options: []
        );

        /* Убираем первые две группы ("Все группы", "Разгруппировано")
         * Проверяем наличие имени в группах
        */

        return collect($data['data']['list'])
            ->filter(static fn(array $groups, int $index) => $index > 1)
            ->pluck('name')
            ->contains('MyWorker');
    }
}
