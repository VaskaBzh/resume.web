<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Dto\Sub\SubViewData;
use App\Models\MinerStat;
use App\Models\Sub;
use App\Models\User;
use App\Services\External\ClientContract;
use App\Services\External\TransformContract;
use App\Utils\Helper;

final readonly class SubService
{
    public function __construct(
        private ClientContract $client,
        private TransformContract $transform,
    ) {
    }

    public function handleSub(Sub $sub): SubViewData
    {
        $remoteSub = $this->client->getSub(groupId: $sub->group_id);

        return $this->transform->transformSub($sub, $remoteSub->toArray());
    }

    public function handleSubList(User $user)
    {
        $remoteSubs = $this->client->getSubList();

        $subs = $user->subs()
            ->whereIn('group_id', $remoteSubs->pluck('gid'))
            ->with(['workers'])
            ->orderByDesc('group_id')
            ->get();

        $remoteSubs = $remoteSubs
            ->whereIn('gid', $subs->pluck('group_id'))
            ->sortByDesc('gid');

        dd($subs, $remoteSubs);
        ////            ->map(function (array $remoteSub) use ($subs) {
        ////                $subs->each(function (Sub $sub) use ($remoteSub) {
        ////                    return $this->transform->transformSub($sub, $remoteSub);
        ////                });
        ////            })
        ////        ;
        //
        //        $subCollection = $subs->map(function (Sub $sub) {
        //            return $this->transform->transformSub($sub)
        //        });
    }

    /**
     * Прогноз дохода на сегодня
     */
    public function todayForecast(float $hashPerDay, float $fee): string
    {
        return number_format(Helper::calculateEarn(
            stats: MinerStat::first(),
            hashRate: $hashPerDay,
            fee: $fee
        ), 8, '.', ' ');
    }
}
