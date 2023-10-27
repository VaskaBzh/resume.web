<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'unique:users,name|min:3|string',
            'email' => 'unique:users,email|email|string',
            'phone' => 'regex:/^\+?(\d[\d\-. ]+)?(\([\d\-. ]+\))?[\d\-. ]+\d$/|unique:users,phone|',
            'sms' => 'bool',
            'auth_2fac' => 'bool'
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'Этот логин уже зарегистрирован',
            'name.min' => 'Минимум 3 символа в логине',
            'name.required' => 'Необходимо ввести логин',
            'email.unique' => 'Этот адрес электронной почты уже зарегистрирован',
            'email.email' => 'Новый адрес электронной почты должен быть действительным',
            'email.required' => 'Необходимо ввести почту',
            'phone.regex' => 'Ваш номер телефона должен быть действительным',
            'phone.unique' => 'Этот номер телефона уже зарегистрирован',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
