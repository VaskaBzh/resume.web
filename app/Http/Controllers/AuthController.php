<?php

namespace App\Http\Controllers;

use App\Http\Middleware\HandleInertiaRequests;
use App\Mail\User\PasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Inertia\Inertia;



class AuthController extends Controller
{

    public function validation_email(Request $request)
    {
        $data = $request->validate([
            "email" => "unique:users,email",
        ]);
        $password = Str::random(10);
        $data['password'] = Hash::make($password);
        $data['name'] = 'Unknown';
        User::firstOrCreate(['email' => $data['email']], $data);
        Mail::to($data['email'])->send(new PasswordMail($password));
        // rebase!!!!!
        return Inertia::location('#login');
        // rebase!!!!!
    }


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
