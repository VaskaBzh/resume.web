<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use OpenApi\Attributes as OA;

#[
    OA\Schema(
        schema: 'ChangePasswordRequest',
        required: ['old_password', 'password', 'password_confirmation'],
        properties: [
            new OA\Property(property: 'old_password', type: 'string'),
            new OA\Property(property: 'password', type: 'string'),
            new OA\Property(property: 'password_confirmation', type: 'string'),
        ],
        type: 'object'
    )
]
class ChangePasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'old_password' => 'required|string',
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'password.required' => __('validation.required', [
                'attribute' => __('validation.attributes.password')
            ]),
            'password.confirmed' => __('validation.confirmed', [
                'attribute' => __('validation.attributes.password')
            ])
        ];
    }
}
