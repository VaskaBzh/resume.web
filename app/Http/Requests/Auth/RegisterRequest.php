<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Rules\User\OnlyEngNameRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', new OnlyEngNameRule, 'min:3', 'unique:users,name'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:10', 'max:50', 'confirmed', 'regex:/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)/'],
            'referral_code' => ['string', 'nullable', 'exists:users,referral_code'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation.required', ['attribute' => __('validation.attributes.name')]),
            'name.unique' => __('validation.unique', ['attribute' => __('validation.attributes.user')]),
            'name.regex' => __('validation.regex', ['attribute' => __('validation.attributes.name')]),
            'password.required' => __('validation.required', ['attribute' => __('validation.attributes.password')]),
            'password.min' => __('validation.min.string', [
                'attribute' => __('validation.attributes.password'), 'min' => 8]
            ),
            'name.min' => __('validation.min.string', [
                'attribute' => __('validation.attributes.name'), 'min' => 8]
            ),
            'password.confirmed' => __('validation.confirmed', ['attribute' => __('validation.attributes.password')]),
            'referral_code.exists' => __('validation.exists', ['attribute' => __('validation.attributes.referral_code')]),
        ];
    }
}
