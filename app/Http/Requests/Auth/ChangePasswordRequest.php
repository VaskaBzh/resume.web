<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ChangePasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => ['required', 'confirmed', Password::defaults()],
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
