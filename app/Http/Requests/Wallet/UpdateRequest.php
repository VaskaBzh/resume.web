<?php

declare(strict_types=1);

namespace App\Http\Requests\Wallet;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'group_id' => 'required',
            'name' => 'required|string|min:3',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'name.min' => trans('validation.min.string', ['attribute' => __('validation.attributes.wallet_name')]),
            'name.required' => trans('validation.required', ['attribute' => __('validation.attributes.wallet_name')])
        ];
    }
}
