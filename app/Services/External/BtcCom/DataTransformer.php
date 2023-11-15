<?php

declare(strict_types=1);

namespace App\Services\External\BtcCom;

use App\Dto\Sub\TransformSubData;
use App\Models\Sub;
use App\Services\External\TransformContract;
use App\ValueObjects\HashRate;
use Illuminate\Support\Collection;

class DataTransformer implements TransformContract
{
    public function transformSub(Sub $sub, array $data): TransformSubData
    {
        $hashPerDay = HashRate::from($sub->hash_rate);

        $subData = [
            'sub' => $sub->sub,
            'user_id' => $sub->user_id,
            'pending_amount' => $sub->pending_amount,
            'group_id' => $sub->group_id,
            'hash_per_day' => $hashPerDay->value,
            'hash_per_day_unit' => $hashPerDay->unit,
            'total_payout' => $sub->total_payout,
            'total_amount' => $sub->total_amount,
            'yesterday_amount' => $sub->yesterday_amount,
        ];

        return TransformSubData::fromArray(data: array_merge($subData, $data));
    }

    public function transformCollection(): Collection
    {
        return collect();
    }
}
