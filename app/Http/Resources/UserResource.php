<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Http\Resources\Sub\GeneralSubsDataResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

/**
 * @mixin User
 */
#[
    OA\Schema(
        schema: 'UserResource',
        properties: [
            new OA\Property(property: 'id', type: 'integer'),
            new OA\Property(property: 'name', type: 'string'),
            new OA\Property(property: 'email', type: 'string'),
            new OA\Property(property: 'email_verified_at', type: 'string'),
            new OA\Property(property: 'phone', type: 'integer'),
            new OA\Property(property: 'sms', type: 'boolean'),
            new OA\Property(property: '2fa', type: 'boolean'),
            new OA\Property(property: 'referral_url', type: 'string'),
            new OA\Property(property: 'has_referral_role', type: 'bool'),
            new OA\Property(
                property: 'general_subs_data',
                type: 'array',
                items: new OA\Items(ref: '#/components/schemas/GeneralSubsDataResource')
            ),
        ],
        type: 'object'
    )
]
class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->hasVerifiedEmail(),
            'phone' => $this->phone,
            'sms' => $this->sms,
            '2fa' => ! is_null($this->google2fa_secret),
            'referral_url' => route('v1.register', 'referral_code='.$this->referral_code),
            'has_referrer_role' => $this->hasRole('referrer'),
            'general_subs_data' => new GeneralSubsDataResource($this),
        ];
    }
}
