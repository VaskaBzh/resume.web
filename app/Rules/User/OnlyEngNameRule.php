<?php

namespace App\Rules\User;

use Illuminate\Contracts\Validation\InvokableRule;

class OnlyEngNameRule implements InvokableRule
{
    public function __invoke($attribute, $value, $fail)
    {
        if (!preg_match('/^[A-aZ-z0-9]+$/', $value)) {
            $fail('Имя должно содержать только английские символы');
        }
    }
}
