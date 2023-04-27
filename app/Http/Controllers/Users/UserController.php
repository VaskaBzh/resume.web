<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function email()
    {
        if (Auth::user() && Auth::user()->email) {
            return Auth::user()->email;
        }
        return back()->withErrors(['email' => 'Почта не найдена.']);
    }

    public function login()
    {
        if (Auth::user() && Auth::user()->name) {
            return Auth::user()->name;
        }
        return back()->withErrors(['login' => 'Логин не найден.']);
    }

    public function phone()
    {
        if (Auth::user() && Auth::user()->phone) {
            return Auth::user()->phone;
        }
        return 'Добавьте телефон.';
    }

    public function sms()
    {
        if (Auth::user() && Auth::user()->sms !== null) {
            return Auth::user()->sms;
        }
    }

    public function fac()
    {
        if (Auth::user() && Auth::user()->auth_2fac !== null) {
            return Auth::user()->auth_2fac;
        }
    }

    public function change(Request $request)
    {
        $request->validate([
            'item' => 'required',
            'type' => 'required',
        ]);

        $user = auth()->user();

        if ($request->input("type") === 'Логин') {
            $request->validate([
                'item' => 'unique:users,name|min:3',
            ], [
                'item.min' => 'Минимум 3 символа в логине.',
                'item.unique' => 'Этот логин уже зарегистрирован.',
            ]);

            $user->name = $request->input("item");

            $message = 'Логин успешно изменен!';
        }

        if ($request->input("type") === 'Email') {
            $request->validate([
                'item' => 'unique:users,email|email',
            ], [
                'item.email' => 'Новый адрес электронной почты должен быть действительным.',
                'item.unique' => 'Этот адрес электронной почты уже зарегистрирован.',
            ]);

            $user->email = $request->input("item");

            $message = 'Email успешно изменен!';
        }

        if ($request->input("type") === 'Телефон') {
            $request->validate([
                'item' => 'unique:users,phone|regex:/^\+?(\d[\d\-. ]+)?(\([\d\-. ]+\))?[\d\-. ]+\d$/',
            ], [
                'item.regex' => 'Ваш номер телефона должен быть действительным.',
                'item.unique' => 'Этот номер телефона уже зарегистрирован.',
            ]);

            $user->phone = $request->input("item");

            $message = 'Телефон успешно изменен!';
        }

        if ($request->input("type") === 'СМС авторизация') {
            $user->sms = $request->input("item");

            if ($request->input("item") === true) {
                $message = 'Вход по sms успешно подключен!';
            } else {
                $message = 'Вход по sms успешно отключен.';
            }
        }

        if ($request->input("type") === '2х факторная аутентификация') {
            $user->auth_2fac = $request->input("item");

            if ($request->input("item") === true) {
                $message = '2х факторная аутентификация успешно подключена!';
            } else {
                $message = '2х факторная аутентификация успешно отключена.';
            }
        }

        $user->save();

        return back()->with('message', $message);
    }
}
