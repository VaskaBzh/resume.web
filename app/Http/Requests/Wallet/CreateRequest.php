<?php

declare(strict_types=1);

namespace App\Http\Requests\Wallet;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'wallet' => 'required|string|min:20|max:191',
            'group_id' => 'required|unique:wallets',
            'name' => 'string|min:3|nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'wallet.required' => __('validation.required', ['attribute' => __('validation.attributes.wallet')]),
            'wallet.min' => __('validation.min.string', ['attribute' => __('validation.attributes.wallet_address')]),
            'wallet.max' => __('validation.max.string', ['attribute' => __('validation.attributes.wallet_address')]),
            'wallet.unique' => __('validation.unique', ['attribute' => __('validation.attributes.wallet_address')]),
            'name.min' => __('validation.min.string', ['attribute' => __('validation.attributes.wallet_name')]),
            'group_id.unique' => __('validation.custom.attribute-name.group_id_unique',
                ['attribute' => __('validation.attributes.wallet')]
            )
        ];
    }
}
