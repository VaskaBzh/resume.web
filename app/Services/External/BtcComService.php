<?php

declare(strict_types=1);

namespace App\Services\External;

use App\Actions\Sub\Create;
use App\Dto\SubData;
use App\Dto\UserData;
use App\Dto\WorkerData;
use App\Models\MinerStat;
use App\Models\Sub;
use App\Models\Worker;
use App\Utils\Helper;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BtcComService
{
    private PendingRequest $client;
    private static $retryCount = 3;
    private static $pendingTimeSec = 1;
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

    /* ------------------ Btc.com requests ------------------------ */

    /**
     * @param array $segments
     * @param string $method
     * @param array $params
     * @return mixed
     * @throws \Exception
     */
    public function call(array $segments, string $method = 'get', array $params = []): array
    {
        while (self::$retryCount > 0) {
            $response = $this
                ->client
                ->$method(implode('/', $segments), $params);

            Log::channel('btc_com')->info('BTC.COM RESPONSE', ['Response' => $response->json()]);

            if (filled($response['data'])) {

                return $response['data'];
            }

            self::$retryCount--;

            sleep(self::$pendingTimeSec);
        }

        return [];
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

        return collect($response['list'] ?? []);
    }

    /**
     * Инвормация о сабаккаунте
     */
    public function getSub(int $groupId): ?array
    {
        return $this->call(segments: ['groups', $groupId], params: [
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

        $response = $this->call(
            segments: ['groups', 'create'],
            method: 'post',
            params: [
                'puid' => self::PU_ID,
                'group_name' => $userData->name
            ]);

        $this->createLocalSub(userData: $userData, groupId: $response['gid']);

        return $response;
    }

    /**
     * Получить список воркеров
     * Следует обратить внимание, метод принимает в строке запроса
     * параметр group (не group_id)
     */
    public function getWorkerList(?int $groupId = self::UNGROUPED_ID): Collection
    {
        $response = $this->call(
            segments: ['worker'],
            params: [
                'puid' => self::PU_ID,
                'group' => $groupId,
                'page_size' => self::DEFAULT_PAGE_SIZE
            ]
        );

        return collect($response['data']);
    }

    public function getWorker($workerId): Collection
    {
        $response = $this->call(['worker', $workerId], params: [
            'puid' => self::PU_ID,
        ]);

        return collect($response['data']);
    }

    /**
     * Обновить воркер
     */
    public function updateWorker(WorkerData $workerData): void
    {
        $this->call(
            segments: [
                'worker',
                'update'
            ],
            method: 'post',
            params: [
                'puid' => self::PU_ID,
                'group_id' => $workerData->group_id,
                'worker_id' => (string)$workerData->worker_id
            ]);
    }

    public function getFppsRate(): float|int
    {
        $fppsRate = $this->call(['account', 'earn-history'], params: [
            'puid' => self::PU_ID,
            "page_size" => "1",
        ])['list'];

         return collect($fppsRate)->first()['more_than_pps96_rate'];
    }

    /* End requests */

    private static function transform(
        MinerStat $stats,
        Sub       $sub,
        float     $hashPerDay,
        array     $btcComSub
    ): array
    {
        return [
            'sub' => $sub->sub,
            'pending_amount' => $sub->pending_amount,
            'group_id' => $sub->group_id,
            'workers_count_active' => $btcComSub['workers_active'],
            'workers_count_in_active' => $btcComSub['workers_inactive'],
            'workers_count_unstable' => $btcComSub['workers_dead'],
            'hash_per_min' => $btcComSub['shares_1m'],
            'hash_per_day' => $hashPerDay,
            'today_forecast' => number_format(Helper::calculateEarn(
                stats: $stats,
                hashRate: $hashPerDay,
                fee: BtcComService::FEE
            ), 8, '.', ' '),
            'reject_percent' => $btcComSub['reject_percent'],
            'unit' => $btcComSub['shares_unit'],
            'total_payout' => $sub->total_payout,
            'yesterday_amount' => $sub->yesterday_amount,
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

    private function createLocalSub(UserData $userData, $groupId): string
    {
        try {
            $sub = Create::execute(
                subData: SubData::fromRequest([
                    'user_id' => auth()->user()->id,
                    'group_id' => $groupId,
                    'group_name' => $userData->name,
                ])
            );

            return $sub->sub;
        } catch (\Exception $e) {
            report($e);

            throw new \Exception($e->getMessage());
        }

    }
}
