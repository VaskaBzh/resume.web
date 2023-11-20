<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Dto\Sub\SubViewData;
use App\Models\Sub;
use App\Models\User;
use App\Services\External\ClientContract;
use App\Services\External\TransformContract;
use Illuminate\Support\Collection;

final readonly class SubService
{
    public function __construct(
        private ClientContract    $client,
        private TransformContract $transform,
    )
    {
    }

    public function getSub(Sub $sub): SubViewData
    {
        $sub->load('workers');
        $remoteSub = $this->client->getSub(groupId: $sub->group_id);

        return $this->transform->transformSub($sub, $remoteSub->toArray());
    }

    public function getSubList(User $user): Collection
    {
        $remoteSubs = $this->client->getSubList();

        $localUserSubs = $user->subs()
            ->whereIn('group_id', $remoteSubs->pluck('gid'))
            ->with(['workers'])
            ->orderByDesc('group_id')
            ->get();

        return [
            'transformed' => $remoteSubs
                ->whereIn('gid', $localUserSubs->pluck('group_id'))
                ->sortByDesc('gid')
                ->map(function (array $remoteSub) use ($localUserSubs) {
                    foreach ($localUserSubs as $sub) {
                        return $this->transform->transformSub($sub, $remoteSub);
                    }
                })->filter(),
            'overral' =>
    }
}
