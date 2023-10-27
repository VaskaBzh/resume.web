<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[
    OA\Schema(
        schema: 'LoginRequest',
        type: 'object',
        example: [
            "email" => "user@example.com",
            "password" => "password",
        ],
        oneOf: [
            new OA\Property(
                property: "email",
                description: "User's email",
                type: "string",
                format: "email",
            ),
            new OA\Property(
                property: "password",
                description: "User's password",
                type: "string",
            ),
            new OA\Property(
                property: "google2fa_code",
                description: "Google Authenticator code",
                type: "string",
                maxLength: 6,
                minLength: 6
            ),
        ]
    )
]
class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|string|max:254',
            'password' => 'required',
            'google2fa_code' => 'string|numeric|digits:6'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'email.required' => __('validation.required', ['attribute' => 'email']),
            'email.email' => __('validation.email', ['attribute' => 'email']),
            'email.max' => __('validation.max.string', ['attribute' => 'email', 'max' => 254]),
            'password.required' => __('validation.required', ['attribute' => __('validation.attributes.password')])
        ];
    }
}
