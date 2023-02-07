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

        if (!auth("web")->attempt($data)) {
            return back()->withErrors(
                ["email" => "Неверный логин или пароль"]
            );
        }

        return redirect()->route("profile");
    }

    public function logout()
    {
        auth("web")->logout();

        return redirect()->route("home");
    }

}
