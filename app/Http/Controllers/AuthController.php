<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            "email" => ["required", "email", "string"],
            "password" => ["required"],
        ]);

        if (auth("web")->attempt($data)) {
            return redirect()->route("profile");
        }

        return redirect(route("login"))->withErrors(
            ["email" => "Пользователь не найден, либо данные введены не правильно"]
        );
    }
    public function logout()
    {
        auth("web")->logout();

        return redirect()->route("home");
    }

}
