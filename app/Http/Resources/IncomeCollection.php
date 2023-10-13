<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Income;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @see Income
 *
 * @OA\Schema(
 *     schema="IncomeCollection",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(
 *             type="object",
 *             @OA\Property(property="referral_id", type="integer"),
 *             @OA\Property(property="amount", type="number"),
 *             @OA\Property(property="hash", type="integer"),
 *             @OA\Property(property="status", type="string"),
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="created_at", type="string"),
 *             @OA\Property(property="updated_at", type="string"),
 *         )
 *     ),
 * )
 */
class IncomeCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'data' => $this->collection->map(static fn(Income $income) => [
                    'referral_id' => $income->referral_id,
                    'amount' => $income->daily_amount,
                    'hash' => $income->hash,
                    'status' => $income->status,
                    'message' => __('statuses.' . $income->message),
                    'created_at' => $income->created_at,
                    'updated_at' => $income->updated_at,
                ]
            ),
        ];
    }
}
