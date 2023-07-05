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

    public function check_users($groupName) {
        $requestController = new RequestController();

        $response = $requestController->proxy([
            "puid" => "781195",
            "page" => 1,
            "page_size" => 52,
        ], "worker/groups", "get");

        foreach (json_decode($response->getContent())->data->list  as $index => $group) {
            if ($index > 1) {
                if ($group->name === $groupName) {
                    if (app()->getLocale() === 'ru') {
                        return back()->withErrors([
                            'name' => 'Аккаунт с таким именем уже существует',
                        ]);
                    } else if (app()->getLocale() === 'en') {
                        return back()->withErrors([
                            'name' => 'An account with that name already exists.',
                        ]);
                    }
                } elseif ($index === count(json_decode($response->getContent())->data->list) - 1) {
                    return false;
                }
            }
        }
    }

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
            "group_name" => 'required|string|min:3|max:16',
        ], $messages);

        $requestController = new RequestController();
        $response = $this->check_users($request->input('group_name'));

        if ($response === false) {
            $responseCreate = $requestController->proxy([
                "puid" => "781195",
                "group_name" => $request->input("group_name"),
            ], "groups/create", "post");
            if ($request->input('user_id')) {
                // Валидация входных данных
                $request->validate([
                    'user_id' => 'required|integer|exists:users,id',
                ]);

                // Создание новой записи о выводе
                $sub = new Sub([
                    'user_id' => $request->input('user_id'),
                    'group_id' => json_decode($responseCreate->getContent())->data->gid,
                    'sub' => $request->input('group_name'),
                ]);
            } else {
                // Создание новой записи о выводе
                $sub = new Sub([
                    'user_id' => Auth::user()->id,
                    'group_id' => json_decode($responseCreate->getContent())->data->gid,
                    'sub' => $request->input('group_name'),
                ]);
            }

            // Сохранение записи в базе данных
            $sub->save();

            // Возвращение успешного ответа (настроить ответ в соответствии с фронтендом)
            if (app()->getLocale() === 'ru') {
                return back()->with([
                    'message' => 'Сабаккаунт создан.',
                ], 201);
            } else if (app()->getLocale() === 'en') {
                return back()->with([
                    'message' => 'The subaccount has been created.',
                ], 201);
            }
        }
        return $response;
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
