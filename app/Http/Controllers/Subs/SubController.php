<?php

namespace App\Http\Controllers\Subs;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Requests\RequestController;
use App\Models\Sub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SubController extends Controller
{

    public function create(Request $request)
    {
        // Валидация входных данных
        $request->validate([
            'group_id' => 'required|string',
            "group_name" => 'required|string|min:3|max:16',
        ], [
            "group_name.max" => "Максимальное количество символов 16.",
            "group_name.min" => "Минимальное количество символов 3.",
        ]);

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
        return response()->json([
            'success' => true,
            'message' => 'Сабаккаунт создан',
        ], 201);
    }

    public function visual()
    {
        return Sub::all()->where('user_id', Auth::user()->id);
    }

    public function change_name(Request $request)
    {
        // Валидация входных данных
        $request->validate([
            'group_id' => 'required|string',
            "group_name" => 'required|string|min:3|max:16',
        ], [
            "group_name.max" => "Максимальное количество символов 16.",
            "group_name.min" => "Минимальное количество символов 3.",
        ]);

        $requestController = new RequestController();

        try {
            $response = json_decode($requestController->proxy($request->all(),"groups/update/" . $request->input("group_id"), "post")->getContent());

            if ($response->data->msg === 'Success') {
                // Обработка успешного обновления
                $sub = Sub::all()->firstWhere('group_id', $request->input("group_id"));

                $message = 'Имя сабаккаунта успешно изменено';

                $sub->sub = $request->input("group_name");
                $sub->save();
            } else {
                // Обработка ошибок, возвращаемых API
                $message = 'Произошла ошибка при смене имени сабаккаунта. Пожалуйста, попробуйте снова';
            }
        } catch (Exception $e) {
            // Обработка ошибок
            $message = 'Произошла ошибка при смене имени сабаккаунта. Пожалуйста, попробуйте снова';
        }

        return back()->with("message", $message);
    }
}
