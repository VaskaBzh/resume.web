<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WalletCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'wallet' => 'required|string|min:20',
            'group_id' => 'required',
            'percentage' => 'required|integer|min:1|max:100',
            'minWithdrawal' => 'required|numeric|gt:0.004',
            'name' => 'required|string|min:3'
        ];
    }

    public function messages(): array
    {
        return [
            'wallet.required' => trans('validation.required', ['attribute' => 'адрес кошелька']),
            'wallet.min' => trans('validation.min.string', ['attribute' => 'адрес кошелька', 'min' => 1]),
            'percent.integer' => trans('validation.integer', ['attribute' => 'Процент']),
            'percent.min' => trans('validation.min.numeric', [
                'attribute' => 'Процент', 'min' =>  1
            ]),
            'percent.max' => trans('validation.min.numeric', ['attribute' => 'Процент', 'max' => 100]),
            'minWithdrawal.numeric' => trans('validation.numeric', ['attribute' => 'Вывод']),
            'minWithdrawal.gt' => trans('validation.gt.numeric', ['attribute' => 'Вывод', 'gt' => 0.005]),
            'name.min' => trans('validation.min.string', ['attribute' => 'Имя', 'min' => 3]),
        ];
    }
}
