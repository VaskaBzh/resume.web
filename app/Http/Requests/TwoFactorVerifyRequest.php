<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TwoFactorVerifyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'twoFactorSecret' => 'required|string|numeric'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
