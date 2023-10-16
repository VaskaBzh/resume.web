<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TwoFactorVerifyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|numeric|digits:6',
            'secret' => 'required|string'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
