<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
            return User::all()->where("email", $request->input("email"))->first()->id;
        }
    }

}
