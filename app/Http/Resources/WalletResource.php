<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Wallet;
use Illuminate\Http\Resources\Json\JsonResource;

/** @see Wallet
 *
 * @OA\Schema(
 *      schema="WalletResource",
 *      type="object",
 *      @OA\Property(property="id", type="integer"),
 *      @OA\Property(property="percent", type="float"),
 *      @OA\Property(property="minWithdrawal", type="float"),
 *      @OA\Property(property="wallet", type="string"),
 *      @OA\Property(property="name", type="string"),
 *      @OA\Property(property="total_payout", type="float"),
 *      @OA\Property(property="is_unlocked", type="boolean"),
 * )
 */
class WalletResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'percent' => $this->percent,
            'minWithdrawal' => $this->minWithdrawal,
            'wallet' => $this->wallet,
            'name' => $this->name,
            'total_payout' => $this->total_payout,
            'is_unlocked' => $this->isUnlocked(),
        ];
    }
}
