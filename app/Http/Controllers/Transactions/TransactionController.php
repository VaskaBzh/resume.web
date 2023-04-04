<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // Функция для обработки запроса на вывод
    public function store(Request $request)
    {
        // Валидация входных данных
        if ($request->input('user_id')) {
            $request->validate([
                'user_id' => 'required|integer|exists:users,id',
                'wallet_address' => 'required|string',
                'amount' => 'required|numeric|min:0.00000001', // Минимальная сумма, которую пользователь может запросить
//            'percent' => 'required', // Минимальная сумма, которую пользователь может запросить
            ]);

            // Создание новой записи о выводе
            $transaction = new Transaction([
                'user_id' => $request->input('user_id'),
                'wallet_address' => $request->input('wallet_address'),
                'amount' => $request->input('amount'),
//            'percent' => $request->input('percent'),
                'status' => 'pending',
            ]);
        } else {
            $request->validate([
                'wallet_address' => 'required|string',
                'amount' => 'required|numeric|min:0.00000001', // Минимальная сумма, которую пользователь может запросить
            ]);

            // Создание новой записи о выводе
            $transaction = new Transaction([
                'user_id' => Auth::user()->id,
                'wallet_address' => $request->input('wallet_address'),
                'amount' => $request->input('amount'),
                'status' => 'pending',
            ]);
        }

        // Сохранение записи в базе данных
        $transaction->save();

        // Возвращение успешного ответа (настроить ответ в соответствии с фронтендом)
        return response()->json([
            'success' => true,
            'message' => 'Запрос на вывод успешно создан',
        ], 201);
    }

    public function render()
    {
        $transaction = Transaction::all();

        // Возвращение успешного ответа (настроить ответ в соответствии с фронтендом)
        return response()->json([
            'success' => true,
            'data' => $transaction,
        ], 201);
    }
}
