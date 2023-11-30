<?php

declare(strict_types=1);

namespace App\Http\Requests\GoogleTwoFactor;

use Illuminate\Foundation\Http\FormRequest;

class EnableRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|string|digits:6',
            'secret' => 'required|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
