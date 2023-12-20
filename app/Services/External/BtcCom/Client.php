<?php

declare(strict_types=1);

namespace App\Services\External\BtcCom;

use App\Exceptions\BusinessException;
use App\Models\Worker;
use App\Services\External\ApiRequest;
use App\Services\External\BaseClient;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class Client extends BaseClient implements ClientContract
{
    protected function baseUrl(): string
    {
        return config('api.btc.url');
    }

    protected function authorize(PendingRequest $request): PendingRequest
    {
        return $request->withHeaders(['Authorization' => config('api.btc.token')]);
    }

    /* ------------------ Sub-accounts ------------------ */

    /**
     * Get remote sub-account
     */
    public function getSub(int $groupId): Collection
    {
        return $this->send(
            request: ApiRequest::get(
                uri: str_replace('{group}', "$groupId", config('api.btc.paths.group'))
            )->setQuery('puid', config('api.btc.puid'))
        )->collect('data');

    }

    /**
     * Get remote sub-account list
     */
    public function getSubList(): Collection
    {
        return $this->send(
            request: ApiRequest::get(uri: config('api.btc.paths.group list'))
                ->setQuery('puid', config('api.btc.puid'))
                ->setQuery('page_size', config('api.btc.default_page_size'))
        )
            ->collect('data.list')
            ->slice(2);
    }

    /**
     * Create remote sub-account by user name
     */
    public function createRemoteSub(string $subName): Collection
    {
        $btcComSub = $this->send(
            request: ApiRequest::post(uri: config('api.btc.paths.create group'))
                ->setQuery('puid', config('api.btc.puid'))
                ->setQuery('group_name', $subName)
        )->collect('data');

        if (in_array('exist', $btcComSub->toArray(), true)) {

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
        return $this->send(
            request: ApiRequest::get(uri: config('api.btc.paths.worker list'))
                ->setQuery('puid', config('api.btc.puid'))
                ->setQuery('group', (string) $groupId)
                ->setQuery('page_size', config('api.btc.default_page_size'))
                ->setQuery('status', $workerStatus)
        )->collect('data.data');
    }

    /**
     * Update remote worker group
     */
    public function updateRemoteWorkers(Collection $data): void
    {
        $data->each(function (Worker $worker) {
            $this->send(
                request: ApiRequest::post(uri: config('api.btc.paths.update worker'))
                    ->setQuery('puid', config('api.btc.puid'))
                    ->setQuery('group_id', (string) $worker->group_id)
                    ->setQuery('worker_id', (string) $worker->worker_id)
            );

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
        return Arr::first($this->send(
            request: ApiRequest::get(uri: config('api.btc.paths.earn history'))
                ->setQuery('puid', config('api.btc.puid'))
                ->setQuery('page_size', '1')
        )->collect('data.list.0.more_than_pps96_rate'));
    }
}
