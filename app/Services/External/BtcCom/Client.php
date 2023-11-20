<?php

declare(strict_types=1);

namespace App\Services\External\BtcCom;

use App\Exceptions\BusinessException;
use App\Models\Worker;
use App\Services\External\ClientContract;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class Client implements ClientContract
{
    /**
     * Call btc.com
     */
    public function call(
        string $path,
        string $method = 'get',
        array $params = []
    ): Collection {
        $params['puid'] = config('api.btc.puid');

        $client = Http::baseUrl(
            url: config('api.btc.url')
        )->withHeaders(
            headers: ['Authorization' => config('api.btc.token')]
        );

        $delay = config('api.btc.delay_sec');
        $retry = config('api.btc.retry_count');

        while ($retry > 0) {
            $response = $client->$method($path, $params);

            if (isset($response['data'])) {

                return collect($response['data']);
            }

            $retry--;

            usleep($delay);
        }

        return collect();
    }

    /* ------------------ Sub-accounts ------------------ */

    /**
     * Get remote sub-account
     */
    public function getSub(int $groupId): Collection
    {
        return $this->call(path: str_replace('{group}',
            "$groupId",
            config('api.btc.paths.group'))
        );
    }

    /**
     * Get remote sub-account list
     */
    public function getSubList(): Collection
    {
        $btcComSubs = $this->call(
            path: config('api.btc.paths.group list'),
            params: [
                'page_size' => config('api.btc.default_page_size'),
            ]
        );

        if ($btcComSubs->has('list')) {
            return collect($btcComSubs->get('list'))
                ->filter(static fn (array $groups, int $index) => $index > 1);
        }

        return collect();
    }

    /**
     * Create remote sub-account by user name
     */
    public function createRemoteSub(string $subName): Collection
    {
        $btcComSub = $this->call(
            path: config('api.btc.paths.create group'),
            method: 'post',
            params: [
                'group_name' => $subName,
            ]);

        if ($btcComSub->get('exist') === true) {
            throw new BusinessException(
                __('actions.sub_account_already_exist'),
                Response::HTTP_BAD_REQUEST
            );
        }

        return $btcComSub;
    }

    /* --------------------- Workers -------------------- */

    /**
     *  Get remote worker list by status & group_id
     *
     * @throws \Exception
     */
    public function getWorkerList(int $groupId, ?string $workerStatus = 'all'): Collection
    {
        $workers = $this->call(
            path: config('api.btc.paths.worker list'),
            params: [
                'group' => $groupId,
                'page_size' => config('api.btc.default_page_size'),
                'status' => $workerStatus,
            ]
        );

        return $workers->has('data') ? collect($workers->get('data')) : collect();
    }

    /**
     * Update remote worker group
     */
    public function updateRemoteWorkers(Collection $data): void
    {
        $data->each(function (Worker $worker) {
            $this->call(
                path: config('api.btc.paths.update worker'),
                method: 'post',
                params: [
                    'group_id' => $worker->group_id,
                    'worker_id' => (string) $worker->worker_id,
                ]);

            usleep(config('api.btc.delay_sec'));
        });
    }

    /**
     * Get btc.com fpps rate
     *
     * @throws \Exception
     */
    public function getFppsRate(): float|int
    {
        $fppsRate = $this->call(
            path: config('api.btc.paths.earn history'),
            params: ['page_size' => '1']
        );

        return Arr::get($fppsRate->get('list'), '0.more_than_pps96_rate');
    }
}
