<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="ChartResource",
 *     type="object",
 *     @OA\Property(
 *         property="values",
 *         type="array",
 *         @OA\Items(
 *             type="object",
 *             @OA\Property(property="x", type="integer"),
 *             @OA\Property(property="y", type="integer"),
 *         )
 *     ),
 * )
 */
class ChartResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request): array
    {
        return [
            'values' => $this['values']
        ];
    }
}
