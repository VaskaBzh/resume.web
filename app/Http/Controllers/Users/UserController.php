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
        if (Auth::user() && Auth::user()->phone) {
            return Auth::user()->sms;
        }
    }

    public function fac()
    {
        if (Auth::user() && Auth::user()->phone) {
            return Auth::user()->auth_fac_2;
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
            $user->save();

            return back()->with('message', 'Логин успешно изменен!');
        }

        if ($request->input("type") === 'Email') {
            $request->validate([
                'item' => 'unique:users,email|email',
            ], [
                'item.email' => 'Новый адрес электронной почты должен быть действительным.',
                'item.unique' => 'Этот адрес электронной почты уже зарегистрирован.',
            ]);

            $user->email = $request->input("item");
            $user->save();

            return back()->with('message', 'Email успешно изменен!');
        }

        if ($request->input("type") === 'Телефон') {
            $request->validate([
                'item' => 'unique:users,phone|regex:/^\+?(\d[\d\-. ]+)?(\([\d\-. ]+\))?[\d\-. ]+\d$/',
            ], [
                'item.regex' => 'Ваш номер телефона должен быть действительным.',
                'item.unique' => 'Этот номер телефона уже зарегистрирован.',
            ]);

            $user->phone = $request->input("item");
            $user->save();

            return back()->with('message', 'Телефон успешно изменен!');
        }

        if ($request->input("type") === 'СМС авторизация') {
            $user->sms = $request->input("item");
            $user->save();

            if ($request->input("item") === true) {
                return back()->with('message', 'Вход по sms успешно подключен!');
            } else {
                return back()->with('message', 'Вход по sms успешно отключен.');
            }
        }

        if ($request->input("type") === '2х факторная аутентификация') {
            $user->auth_2fac = $request->input("item");
            $user->save();

            if ($request->input("item") === true) {
                return back()->with('message', '2х факторная аутентификация успешно подключена!');
            } else {
                return back()->with('message', '2х факторная аутентификация успешно отключена.');
            }
        }
    }
}
