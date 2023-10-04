<?php

namespace App\Http\Requests\Wallet;

use Illuminate\Foundation\Http\FormRequest;

class ChangeAddressRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'wallet_address' => ['required', 'string'],
            'confirmation_code' => ['required', 'numeric', 'digits:5', 'exists:confirmation_codes,code']
        ];
    }

    public function messages(): array
    {
        return [
            'wallet_address.required' => __('validation.required', ['attribute' => __('validation.attributes.wallet_address')]),
            'wallet_address.string' => __('validation.string', ['attribute' => __('validation.attributes.wallet_address')]),
            'confirmation_code.exists' => __('validation.custom.attribute-name.confirmation_code_exists')
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
