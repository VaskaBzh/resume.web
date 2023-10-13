<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

/**
 * @mixin User
 */

#[
    OA\Schema(
        schema: "Role",
        properties: [
            new OA\Property(property: "id", type: "integer"),
            new OA\Property(property: "name", type: "string"),
            new OA\Property(property: "guard_name", type: "string"),
            new OA\Property(property: "created_at", type: "string"),
            new OA\Property(property: "updated_at", type: "string"),
        ]
    ),
    OA\Schema(
        schema: "UserResource",
        properties: [
            new OA\Property(property: "id", type: "integer"),
            new OA\Property(property: "name", type: "string"),
            new OA\Property(property: "email", type: "string"),
            new OA\Property(property: "email_verified_at", type: "string"),
            new OA\Property(property: "phone", type: "integer"),
            new OA\Property(property: "sms", type: "boolean"),
            new OA\Property(property: "2fa", type: "boolean"),
            new OA\Property(property: "referral_code", type: "string"),
            new OA\Property(
                property: "roles",
                type: "array",
                items: new OA\Items(ref: '#/components/schemas/Role')
            ),
        ],
        type: "object"
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
            'email_verified_at' => $this->email_verified_at,
            'phone' => $this->phone,
            'sms' => (bool) $this->sms,
            '2fa' => !is_null($this->google2fa_secret),
            'referral_code' => $this->referral_code,
            'roles' => $this->roles,
        ];
    }
}
