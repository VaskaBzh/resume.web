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
            'percent' => 'required|integer|min:1|max:100',
            'minWithdrawal' => 'required|numeric|gt:0.0049',
            'name' => 'string|min:3|nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'wallet.required' => trans('validation.required', ['attribute' => 'Aдрес кошелька']),
            'wallet.min' => trans('validation.min.string', ['attribute' => 'Aдрес кошелька']),
            'wallet.max' => trans('validation.max.string', ['attribute' => 'Aдрес кошелька']),
            'wallet.unique' => trans('validation.unique', ['attribute' => 'Aдрес кошелька']),
            'percent.integer' => trans('validation.integer', ['attribute' => 'Процент']),
            'percent.required'=> trans('validation.required', ['attribute' => 'Процент']),
            'percent.min' => trans('validation.min.numeric', [
                'attribute' => 'Процент', 'min' =>  1
            ]),
            'percent.max' => trans('validation.min.numeric', ['attribute' => 'Процент', 'max' => 100]),
            'minWithdrawal.numeric' => trans('validation.numeric', ['attribute' => 'Вывод']),
            'minWithdrawal.gt' => trans('validation.gt.numeric', ['attribute' => 'Вывод', 'gt' => 0.005]),
            'name.min' => trans('validation.min.string', ['attribute' => 'Имя', 'min' => 3]),
            'group_id.unique' => trans('validation.exists', ['attribute' => 'Кошелек'])
        ];
    }
}
