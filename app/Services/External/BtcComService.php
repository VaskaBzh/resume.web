<?php

declare(strict_types=1);

namespace App\Services\External;

use App\Actions\Sub\Create;
use App\Actions\Worker\Update;
use App\Actions\Worker\Create as WorkerCreate;
use App\Dto\SubData;
use App\Dto\UserData;
use App\Dto\WorkerData;
use App\Dto\WorkerHashRateData;
use App\Exceptions\BusinessException;
use App\Models\MinerStat;
use App\Models\Sub;
use App\Models\Worker;
use App\Utils\Helper;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class BtcComService
{
    private static int $pendingTimeSec = 1;
    private const DEFAULT_PAGE_SIZE = 1000;
    private const PU_ID = 781195;
    private const UNGROUPED_ID = -1;
    public const FEE = 0.5;

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
        $client = Http::baseUrl(config('api.btc.uri'))
            ->withHeaders([
                'Authorization' => config('api.btc.token'),
            ]);

        $retryCount = 3;

        while ($retryCount > 0) {
            $response = $client->$method(implode('/', $segments), $params);

            if (filled($response['data'])) {

                return $response['data'];
            }

            $retryCount--;

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
     * Создать sub аккаунт по имени пользователя на btc.com
     */
    public function createSub(UserData $userData): array
    {
        $response = $this->call(
            segments: ['groups', 'create'],
            method: 'post',
            params: [
                'puid' => self::PU_ID,
                'group_name' => $userData->name
            ]);

        if (in_array('exist', $response)) {

            throw new BusinessException(
                __('actions.sub_account_already_exist'),
                Response::HTTP_BAD_REQUEST
            );
        }

        return $response;
    }

    /**
     * Получить список воркеров
     * Следует обратить внимание, метод принимает в строке запроса
     * параметр group (не group_id)
     */
    public function getWorkerList(
        ?int    $groupId = self::UNGROUPED_ID,
        ?string $workerStatus = 'all'
    ): Collection
    {
        $response = $this->call(
            segments: ['worker'],
            params: [
                'puid' => self::PU_ID,
                'group' => $groupId,
                'page_size' => self::DEFAULT_PAGE_SIZE,
                'status' => $workerStatus
            ]
        );

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
            'user_id' => $sub->user->id,
            'pending_amount' => $sub->pending_amount,
            'group_id' => $sub->group_id,
            'workers_count_active' => $btcComSub['workers_active'],
            'workers_count_in_active' => $btcComSub['workers_inactive'],
            'workers_count_unstable' => $btcComSub['workers_dead'],
            'hash_per_min' => (float)$btcComSub['shares_1m'],
            'hash_per_day' => $hashPerDay,
            'today_forecast' => number_format(Helper::calculateEarn(
                stats: $stats,
                hashRate: $hashPerDay,
                fee: BtcComService::FEE
            ), 8, '.', ' '),
            'reject_percent' => (float)$btcComSub['reject_percent'],
            'unit' => $btcComSub['shares_unit'],
            'total_payout' => $sub->total_payout,
            'yesterday_amount' => (float)$sub->yesterday_amount,
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
        return $this
            ->filterUngrouped()
            ->whereIn('gid', $subs->pluck('group_id')->toArray())
            ->map(function (array $btcComSub) use ($subs) {
                foreach ($subs as $sub) {
                    if (in_array($sub->group_id, $btcComSub)) {

                        return $this->transformSub($sub);
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
     * Создать локального саба
     *
     */
    public function createLocalSub(UserData $userData, $groupId): void
    {
        Create::execute(
            subData: SubData::fromRequest([
                'user_id' => auth()->user()->id,
                'group_id' => $groupId,
                'group_name' => $userData->name,
            ])
        );
    }

    /**
     * Привести список группированных воркеров бтс.ком в локальный вид
     *
     */
    public function getGroupedWorkerCollection(): Collection
    {
        return $this
            ->getWorkerList(0)
            ->map(static function (array $btcComWorker) {
                if (filled($btcComWorker)) {
                    return WorkerData::fromRequest(requestData: [
                        'group_id' => $btcComWorker['gid'],
                        'worker_id' => $btcComWorker['worker_id'],
                        'name' => $btcComWorker['worker_name'],
                        'approximate_hash_rate' => $btcComWorker['shares_1d'],
                        'status' => $btcComWorker['status'],
                        'unit' => $btcComWorker['shares_unit'],
                        'pool_data' => $btcComWorker
                    ]);
                }
            })->filter();
    }

    /**
     * Привести не разгруппированных воркеров бтс.ком в локальный вид
     * Сформировать первый хеш рейт воркеров
     *
     */
    public function getUngroupedWorkerCollection(): Collection
    {
        return $this
            ->getWorkerList(-1)
            ->map(static function (array $btcComWorker) {
                $subName = head(explode('.', $btcComWorker['worker_name']));

                if ($sub = Sub::where('sub', $subName)->first()) {

                    return [
                        'worker_hash_rate' => WorkerHashRateData::fromRequest(requestData: [
                            'worker_id' => (int)$btcComWorker['worker_id'],
                            'hash' => (int)$btcComWorker['shares_1m'],
                            'unit' => $btcComWorker['shares_unit'],
                        ]),
                        'worker_data' => WorkerData::fromRequest(requestData: [
                            'group_id' => $sub->group_id,
                            'worker_id' => $btcComWorker['worker_id'],
                            'name' => $btcComWorker['worker_name'],
                            'approximate_hash_rate' => $btcComWorker['shares_1d'],
                            'status' => $btcComWorker['status'],
                            'unit' => $btcComWorker['shares_unit'],
                            'pool_data' => $btcComWorker
                        ]),
                    ];
                }
            })->filter();
    }

    public function updateLocalWorkers(): void
    {
        $btcComWorkers = $this->getGroupedWorkerCollection();

        $btcComWorkers->each(static fn(WorkerData $workerData) => Update::execute(workerData: $workerData));

        Log::channel('commands')->info('WORKERS UPDATE COMPLETE');

        Worker::whereNotIn(
            column: 'worker_id',
            values: $btcComWorkers->pluck('worker_id')->toArray()
        )->delete();
    }

    public function createLocalWorkers(): void
    {
        $btcComWorkers = $this->getUngroupedWorkerCollection();

        if ($btcComWorkers->isEmpty()) {
            return;
        }

        $btcComWorkers
            ->each(function (array $firstWorkerData) {

                WorkerCreate::execute($firstWorkerData['worker_data'])
                    ->workerHashrates()
                    ->create([
                        'hash' => (int)$firstWorkerData['worker_hash_rate']['shares_1m'],
                        'unit' => $firstWorkerData['worker_hash_rate']['unit'],
                    ]);

                $this->updateWorker(workerData: $firstWorkerData['worker_data']);
            });

        Artisan::call('make:sub-hashes');

        Log::channel('commands')->info('WORKERS IMPORT COMPLETE');
    }
}
