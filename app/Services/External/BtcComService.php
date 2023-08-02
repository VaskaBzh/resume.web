<?php

declare(strict_types=1);

namespace App\Services\External;

use App\Actions\Sub\Create;
use App\Dto\SubData;
use App\Dto\UserData;
use App\Dto\WorkerData;
use App\Helper;
use App\Models\MinerStat;
use App\Models\Sub;
use App\Models\Worker;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
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

    private static function transform(
        MinerStat $stats,
        Sub       $sub,
        float     $hashPerDay,
        array     $btcComSub
    ): array
    {
        return [
            'sub' => $sub->sub,
            'accruals' => $sub->accruals,
            'group_id' => $sub->group_id,
            'workers_count_active' => $btcComSub['workers_active'],
            'workers_count_in_active' => $btcComSub['workers_inactive'],
            'workers_count_unstable' => $btcComSub['workers_dead'],
            'hash_per_min' => $btcComSub['shares_1m'],
            'hash_per_day' => $hashPerDay,
            'today_forecast' => number_format(Helper::calculateEarn($stats, $hashPerDay), 8, '.', ' '),
            'reject_percent' => $btcComSub['reject_percent'],
            'unit' => $btcComSub['shares_unit'],
            'payments' => $sub->payments,
        ];
    }

    public function transformSub(Sub $sub): array
    {
        return self::transform(
            stats: MinerStat::first(),
            sub: $sub,
            hashPerDay: $this->getSubHashRate(sub: $sub),
            btcComSub: $this->getSub($sub->group_id)
        );
    }

    public function transformSubCollection(Collection $subs): Collection
    {
        $stats = MinerStat::first();

        return $this
            ->filterUngrouped()
            ->whereIn('gid', $subs->pluck('group_id')->toArray())
            ->map(function (array $btcComSub) use ($subs, $stats) {

                foreach ($subs as $sub) {
                    $hashPerDay = $this->getSubHashRate(sub: $sub);

                    if (in_array($sub->group_id, $btcComSub)) {
                        return self::transform(
                            stats: $stats,
                            sub: $sub,
                            hashPerDay: $hashPerDay,
                            btcComSub: $btcComSub
                        );
                    }
                }
            });
    }

    public function getSubHashRate(Sub $sub): float
    {
        return Worker::getByGroupId($sub->group_id)
            ->sum('approximate_hash_rate');
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
        return $this->call(['groups', $groupId], params: [
            'puid' => self::PU_ID,
        ]);
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
    public function getWorkerList(?int $groupId = self::UNGROUPED_ID, ?int $page_size = self::DEFAULT_PAGE_SIZE, ?int $page = 1): Collection
    {
        $response = $this->call(
            segments: ['worker'],
            params: [
                'puid' => self::PU_ID,
                'group' => $groupId,
                'page_size' => $page_size,
                'page' => $page
            ]
        );

        return collect($response['data']);
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

    public function getStats(): array
    {
        $stats = $this->call(['pool', 'status']);
        $fppsRate = $this->call(['account', 'earn-history'], params: [
            'puid' => self::PU_ID,
            "page_size" => "1",
        ])['list'];

        return array_merge($stats, [
            'more_than_pps96_rate' => collect($fppsRate)->first()['more_than_pps96_rate']
        ]);
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
