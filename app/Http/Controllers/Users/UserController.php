<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{
    public function email()
    {
        if (Auth::user() && Auth::user()->email) {
            return Auth::user()->email;
        }
        if (app()->getLocale() === 'ru') {
            return back()->withErrors(['email' => 'Почта не найдена.']);
        } else if (app()->getLocale() === 'en') {
            return back()->withErrors(['email' => 'Email not found.']);
        }
    }

    public function login()
    {
        if (Auth::user() && Auth::user()->name) {
            return Auth::user()->name;
        }
        if (app()->getLocale() === 'ru') {
            return back()->withErrors(['login' => 'Логин не найден.']);
        } else if (app()->getLocale() === 'en') {
            return back()->withErrors(['login' => 'Email not found.']);
        }
    }

    public function phone()
    {
        if (Auth::user() && Auth::user()->phone) {
            return Auth::user()->phone;
        }
        if (app()->getLocale() === 'ru') {
            return 'Добавьте телефон.';
        } else if (app()->getLocale() === 'en') {
            return 'Add a phone number.';
        }
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

        if ($request->input("type") === 'логин') {
            if (app()->getLocale() === 'ru') {
                $messages = [
                    'item.min' => 'Минимум 3 символа в логине.',
                    'item.unique' => 'Этот логин уже зарегистрирован.',
                ];
            } else if (app()->getLocale() === 'en') {
                $messages = [
                    'item.min' => 'Minimum of 3 characters in login.',
                    'item.unique' => 'This login is already registered.',
                ];
            }
            $request->validate([
                'item' => 'unique:users,name|min:3',
            ], $messages);

            $user->name = $request->input("item");

            if (app()->getLocale() === 'ru') {
                $message = 'Логин успешно изменен!';
            } else if (app()->getLocale() === 'en') {
                $message = 'Login successfully changed!';
            }
        }

        if ($request->input("type") === 'email') {
            if (app()->getLocale() === 'ru') {
                $messages = [
                    'item.email' => 'Новый адрес электронной почты должен быть действительным.',
                    'item.unique' => 'Этот адрес электронной почты уже зарегистрирован.',
                ];
            } else if (app()->getLocale() === 'en') {
                $messages = [
                    'item.email' => 'The new email address must be valid.',
                    'item.unique' => 'This email address is already registered.',
                ];
            }
            $request->validate([
                'item' => 'unique:users,email|email',
            ], $messages);

            $user->email = $request->input("item");

            if (app()->getLocale() === 'ru') {
                $message = 'Email успешно изменен!';
            } else if (app()->getLocale() === 'en') {
                $message = 'Email successfully changed!';
            }
        }

        if ($request->input("type") === 'телефон') {
            if (app()->getLocale() === 'ru') {
                $messages = [
                    'item.regex' => 'Ваш номер телефона должен быть действительным.',
                    'item.unique' => 'Этот номер телефона уже зарегистрирован.',
                ];
            } else if (app()->getLocale() === 'en') {
                $messages = [
                    'item.regex' => 'Your phone number must be valid.',
                    'item.unique' => 'This phone number is already registered.',
                ];
            }

            $request->validate([
                'item' => 'unique:users,phone|regex:/^\+?(\d[\d\-. ]+)?(\([\d\-. ]+\))?[\d\-. ]+\d$/',
            ], $messages);

            $user->phone = $request->input("item");

            if (app()->getLocale() === 'ru') {
                $message = 'Телефон успешно изменен!';
            } else if (app()->getLocale() === 'en') {
                $message = 'Phone successfully changed!';
            }
        }

        if ($request->input("type") === 'смс авторизация') {
            $user->sms = $request->input("item");

            if ($request->input("item") === true) {
                if (app()->getLocale() === 'ru') {
                    $message = 'Вход по sms успешно подключен!';
                } else if (app()->getLocale() === 'en') {
                    $message = 'SMS login successfully connected!';
                }
            } else {
                if (app()->getLocale() === 'ru') {
                    $message = 'Вход по sms успешно отключен.';
                } else if (app()->getLocale() === 'en') {
                    $message = 'SMS login successfully disabled.';
                }
            }
        }

        if ($request->input("type") === '2х факторная аутентификация') {
            $user->auth_2fac = $request->input("item");

            if ($request->input("item") === true) {
                if (app()->getLocale() === 'ru') {
                    $message = '2х факторная аутентификация успешно подключена!';
                } else if (app()->getLocale() === 'en') {
                    $message = '2-factor authentication successfully enabled!';
                }
            } else {
                if (app()->getLocale() === 'ru') {
                    $message = '2х факторная аутентификация успешно отключена.';
                } else if (app()->getLocale() === 'en') {
                    $message = '2-factor authentication successfully disabled.';
                }
            }
        }

        $user->save();

        return back()->with('message', $message);
    }
}
