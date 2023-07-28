<?php

declare(strict_types=1);

namespace App\Services\External;

use App\Actions\Sub\Create;
use App\Dto\SubData;
use App\Dto\UserData;
use App\Dto\WorkerData;
use App\Models\Sub;
use App\Models\User;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class BtcComService
{
    private PendingRequest $client;
    private const DEFAULT_PAGE_SIZE = 1000;
    private const PU_ID = 781195;
    private const UNGROUPED_ID = -1;
    public const FEE = 0.5;

    public function __construct()
    {
        $this->client = Http::baseUrl(config('api.btc.uri'))
            ->withHeaders([
                'Authorization' => config('api.btc.token'),
            ]);
    }

    public function call(array $segments, string $method = 'get', array $params = [])
    {
        $response = $this->client->$method(implode('/', $segments), $params)
            ->throwIf(static fn(Response $response) => $response->clientError() || $response->serverError(),
                new \Exception('Ошибка при выполнении запроса')
            );

        return $response['data'];
    }

    public function transformSubCollection(Collection $subs): Collection
    {
        return $this
            ->filterUngrouped()
            ->whereIn('gid', $subs->pluck('group_id')->toArray())
            ->map(static function (array $btcComSub) use ($subs) {
                foreach ($subs as $sub) {
                    if (in_array($sub->group_id, $btcComSub)) {
                        return [
                            'sub' => $sub->sub,
                            'group_id' => $sub->group_id,
                            'workers_count_active' => $btcComSub['workers_active'],
                            'workers_count_in_active' => $btcComSub['workers_inactive'],
                            'workers_count_unstable' => $btcComSub['workers_dead'],
                            'hash_per_min' => $btcComSub['shares_1m'],
                            'unit' => $btcComSub['shares_unit'],
                            'payments' => $sub->payments
                        ];
                    }
                }
            });
    }

    /**
     * Фильтровать -1 и 0 группы
     *
     * @return Collection
     */
    public function filterUngrouped(): Collection
    {
        return collect($this->getGroupList())
            ->filter(static fn(array $groups, int $index) => $index > 1);
    }

    /**
     * Проверка наличия пользователя на стороне btc.com
     *
     * @return bool
     */
    public function btcHasUser(UserData $userData): bool
    {
        return $this->filterUngrouped()
            ->pluck('name')
            ->contains($userData->name);
    }

    /**
     * Получить коллекцию групп
     */
    public function getGroupList(): Collection
    {
        $response = $this->call(
            segments: ['worker', 'groups'],
            params: [
                'puid' => self::PU_ID,
                "page_size" => self::DEFAULT_PAGE_SIZE,
            ]
        );

        return collect($response['list']);
    }

    /**
     * Инвормация о сабаккаунте
     */
    public function getSub(int $groupId): array
    {
        $response = $this->client->get(implode('/', [
            'groups',
            $groupId
        ]), [
                'puid' => self::PU_ID,
            ]
        )->throwIf(static fn(Response $response) => $response->clientError() || $response->serverError(),
            new \Exception('Ошибка при выполнении запроса')
        );

        return $response['data'];
    }

    /**
     * Создать sub аккаунт по имени пользователя
     */
    public function createSub(UserData $userData): array
    {
        if ($this->btcHasUser(userData: $userData)) {
            return [
                'errors' => [
                    'name' => trans('validation.unique', [
                        'attribute' => 'Аккаунт'
                    ])
                ]
            ];
        }

        $response = $this->client->post(implode('/', [
            'groups',
            'create'
        ]), [
            'puid' => self::PU_ID,
            'group_name' => $userData->name
        ])->throwIf(fn(Response $response) => $response->clientError() || $response->serverError(),
            new \Exception('Ошибка при выполнении запроса')
        );

        $this->createLocalSub(userData: $userData, groupId: $response['data']['gid']);

        return $response['data'];
    }

    /**
     * Получить список воркеров
     * Следует обратить внимание, метод принимает в строке запроса
     * параметр group (не group_id)
     */
    public function getWorkerList(?int $groupId = self::UNGROUPED_ID)
    {
        $response = $this->client->get(implode('/', [
            'worker'
        ]), [
            'puid' => self::PU_ID,
            'group' => $groupId,
            'page_size' => self::DEFAULT_PAGE_SIZE
        ])->throwIf(fn(Response $response) => $response->clientError() || $response->serverError(),
            new \Exception('Ошибка при выполнении запроса')
        );

        return collect($response['data']['data']);
    }

    public function getWorker($workerId): Collection
    {
        $response = $this->client->get(implode('/', [
            'worker',
            $workerId
        ]), [
            'puid' => self::PU_ID,
        ])->throwIf(fn(Response $response) => $response->clientError() || $response->serverError(),
            new \Exception('Ошибка при выполнении запроса')
        );

        return collect($response['data']['data']);
    }

    /**
     * Обновить воркер
     */
    public function updateWorker(WorkerData $workerData): void
    {
        $this->client->post(implode('/', [
            'worker',
            'update'
        ]), [
            'puid' => self::PU_ID,
            'group_id' => $workerData->group_id,
            'worker_id' => (string)$workerData->worker_id
        ])->throwIf(fn(Response $response) => $response->clientError() || $response->serverError(),
            new \Exception('Ошибка при выполнении запроса')
        );
    }


    public function getEarnHistory(): array
    {
        dd('s');
        $response = $this->client->get(implode('/', [
            'account',
            'earn-history'
        ]), [
            'puid' => self::PU_ID,
            "page_size" => "1",
        ])->throwIf(fn(Response $response) => $response->clientError() || $response->serverError(),
            new \Exception('Ошибка при выполнении запроса')
        );
        dd($response);
        return $response['data'];
    }

    private function createLocalSub(UserData $userData, $groupId): void
    {
        Create::execute(
            subData: SubData::fromRequest([
                'user_id' => auth()->user()->id,
                'group_id' => $groupId,
                'group_name' => $userData->name,
            ])
        );
    }
}
