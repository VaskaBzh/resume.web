<?php

namespace App\Http\Requests;

use App\Rules\Referral\SelfAttachRule;
use Illuminate\Foundation\Http\FormRequest;

class AttachReferralRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|string|exists:users,referral_code->code',
        ];
    }

    public function messages(): array
    {
        return [
            'exists' => 'Не верный код'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
