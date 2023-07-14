<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:16|min:3'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => trans('validation.required', ['attribute' => 'имя']),
            'name.max' => trans('validation.max.string', ['attribute' => 'Поле имени', 'max' => '16']),
            'name.min' => trans('validation.min.string', ['attribute' => 'Поле имени', 'min' => '3']),
        ];
    }
}
