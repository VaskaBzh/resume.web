<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()) {
            return Auth::user()->id;
        } else {
            $request->validate([
                'email' => 'required|email',
            ]);
            $user = User::where('email', $request->input('email'))->first();

            if ($user) {
                throw ValidationException::withMessages([
                    'email' => 'Пользователь с такой почтой уже существует.',
                ]);
            } else {
                return [
                    'status' => 'success',
                    'user_id' => $user->id,
                ];
            }
        }
    }
}
