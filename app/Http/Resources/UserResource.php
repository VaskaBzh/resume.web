<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\User */
class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'phone' => $this->phone,
            'sms' => $this->sms,
            '2fa' => !is_null($this->google2fa_secret),
            'referral_code' => $this->referral_code,
            'notifications_count' => $this->notifications_count,
            'owner_count' => $this->owner_count,
            'owners_count' => $this->owners_count,
            'permissions_count' => $this->permissions_count,
            'read_notifications_count' => $this->read_notifications_count,
            'roles_count' => $this->roles_count,
            'roles' => $this->roles,
            'subs_count' => $this->subs_count,
            'tokens_count' => $this->tokens_count,
            'unread_notifications_count' => $this->unread_notifications_count,
            'owner' => new SubResource($this->whenLoaded('owner')),
            'owners' => ReferralResourceCollection::collection($this->whenLoaded('owners')),
            'subs' => ReferralResourceCollection::collection($this->whenLoaded('subs')),
        ];
    }
}
