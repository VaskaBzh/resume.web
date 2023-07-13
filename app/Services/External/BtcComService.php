<?php

declare(strict_types=1);

namespace App\Services\External;

use App\Dto\UserData;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class BtcComService
{
    private PendingRequest $client;
    private const DEFAULT_PAGE_SIZE = 1000;
    private const PU_ID = 781195;

    public function __construct()
    {
        $this->client = Http::baseUrl(config('api.btc'))
            ->withHeaders([
                'Authorization' => config('api.btc.token'),
            ]);
    }

    /**
     * Проверка на существование пользователя на стороне btc.com
     * Убираем первые две группы ("Все группы", "Разгруппировано")
     * Проверяем на наличие имени в группах
     */
    public function btcHasUser(UserData $userData): bool
    {
        $data = $this->getGroupList();

        return collect($data['list'])
            ->filter(static fn(array $groups, int $index) => $index > 1)
            ->pluck('name')
            ->contains($userData->name);
    }

    /**
     * Получить коллекцию групп
     */
    public function getGroupList(): array
    {
        $response = $this->client->get(implode('/', [
            'worker',
            'groups',
        ]), [
            'puid' => self::PU_ID,
            "page_size" => self::DEFAULT_PAGE_SIZE,
        ])->throw();

        return $response['data'];
    }

    /**
     * Создать sub аккаунт по имени пользователя
     */
    public function createSub(UserData $userData): array
    {
        $response = $this->client->post(implode('/', [
            'groups',
            'create'
        ]), [
            'puid' => self::PU_ID,
            'group_name' => $userData->name
        ])->throw();

        return $response['data'];
    }
}
