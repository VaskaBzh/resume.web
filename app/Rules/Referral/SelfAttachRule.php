<?php

namespace App\Rules\Referral;

use Illuminate\Contracts\Validation\InvokableRule;

class SelfAttachRule implements InvokableRule
{
    public function __invoke($attribute, $value, $fail)
    {
        if (auth()->user()->id === (int) $value) {
            $fail('Нельзя добавить собственный аккаунт к реферальной программе');
        }
    }
}
