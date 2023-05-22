<?php

namespace App\Http\Controllers\Subs;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Requests\RequestController;
use App\Models\Sub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;


class SubController extends Controller
{

    public function create(Request $request)
    {
        if (app()->getLocale() === 'ru') {
            $messages = [
                "group_name.max" => "Максимальное количество символов 16.",
                "group_name.min" => "Минимальное количество символов 3.",
            ];
        } else if (app()->getLocale() === 'en') {
            $messages = [
                "group_name.max" => "Maximum of 16 characters allowed.",
                "group_name.min" => "Minimum of 3 characters required."
            ];
        }
        // Валидация входных данных
        $request->validate([
            'group_id' => 'required|string',
            "group_name" => 'required|string|min:3|max:16',
        ], $messages);

        if ($request->input('user_id')) {
            // Валидация входных данных
            $request->validate([
                'user_id' => 'required|integer|exists:users,id',
            ]);

            // Создание новой записи о выводе
            $sub = new Sub([
                'user_id' => $request->input('user_id'),
                'group_id' => $request->input('group_id'),
                'sub' => $request->input('group_name'),
            ]);
        } else {
            // Создание новой записи о выводе
            $sub = new Sub([
                'user_id' => Auth::user()->id,
                'group_id' => $request->input('group_id'),
                'sub' => $request->input('group_name'),
            ]);
        }

        // Сохранение записи в базе данных
        $sub->save();

        // Возвращение успешного ответа (настроить ответ в соответствии с фронтендом)
        if (app()->getLocale() === 'ru') {
            return response()->json([
                'success' => true,
                'message' => 'Сабаккаунт создан.',
            ], 201);
        } else if (app()->getLocale() === 'en') {
            return response()->json([
                'success' => true,
                'message' => 'The subaccount has been created.',
            ], 201);
        }
    }

    public function visual()
    {
        return Sub::all()->where('user_id', Auth::user()->id);
    }

    public function change_name(Request $request)
    {
        if (app()->getLocale() === 'ru') {
            $messages = [
                "group_name.max" => "Максимальное количество символов 16.",
                "group_name.min" => "Минимальное количество символов 3.",
            ];
        } else if (app()->getLocale() === 'en') {
            $messages = [
                "group_name.max" => "The maximum number of characters allowed is 16.",
                "group_name.min" => "The minimum number of characters required is 3."
            ];
        }
        // Валидация входных данных
        $request->validate([
            'group_id' => 'required|string',
            "group_name" => 'required|string|min:3|max:16',
        ], $messages);

        $requestController = new RequestController();

        try {
            $response = json_decode($requestController->proxy($request->all(),"groups/update/" . $request->input("group_id"), "post")->getContent());

            if ($response->data->msg === 'Success') {
                // Обработка успешного обновления
                $sub = Sub::all()->firstWhere('group_id', $request->input("group_id"));

                if (app()->getLocale() === 'ru') {
                    $message = 'Имя сабаккаунта успешно изменено';
                } else if (app()->getLocale() === 'en') {
                    $message = 'The subaccount name has been successfully changed.';
                }

                $sub->sub = $request->input("group_name");
                $sub->save();
            } else {
                // Обработка ошибок, возвращаемых API
                if (app()->getLocale() === 'ru') {
                    $message = 'Произошла ошибка при смене имени сабаккаунта. Пожалуйста, попробуйте снова';
                } else if (app()->getLocale() === 'en') {
                    $message = 'An error occurred while changing the subaccount name. Please try again.';
                }
            }
        } catch (Exception $e) {
            // Обработка ошибок
            if (app()->getLocale() === 'ru') {
                $message = 'Произошла ошибка при смене имени сабаккаунта. Пожалуйста, попробуйте снова';
            } else if (app()->getLocale() === 'en') {
                $message = 'An error occurred while changing the subaccount name. Please try again.';
            }
        }

        return back()->with("message", $message);
    }
}
