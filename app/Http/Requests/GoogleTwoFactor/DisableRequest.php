<?php

declare(strict_types=1);

namespace App\Http\Requests\GoogleTwoFactor;

use Illuminate\Foundation\Http\FormRequest;

class DisableRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|digits:6'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
