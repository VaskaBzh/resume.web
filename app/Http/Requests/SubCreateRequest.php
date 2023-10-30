<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\User\OnlyEngNameRule;
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
            'name' => ['required', 'string', 'max:255', 'min:3', new OnlyEngNameRule],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => trans('validation.required', ['attribute' => __('validation.attributes.name')]),
            'name.max' => trans('validation.max.string', [__('validation.attributes.name'), 'max' => '16']),
            'name.min' => trans('validation.min.string', ['attribute' => __('validation.attributes.name'), 'min' => '3']),
        ];
    }
}
