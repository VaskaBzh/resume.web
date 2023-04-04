<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

//    public function login(Request $request)
//    {
//        $this->validateLogin($request);
//
//        // Get user by email
//        $user = User::where('email', $request->email)->first();
//        // Check if the user exists and the email is verified
//        if ($user && $user->hasVerifiedEmail()) {
//            if ($this->attemptLogin($request)) {
//                return $this->sendLoginResponse($request);
//            } else {
//                return $this->sendFailedLoginResponse($request);
//            }
//        } else {
//            // Email not verified
////            throw ValidationException::withMessages([
////                'email' => ['email не подтвержден.'],
////            ]);
//            abort(500, 'Почта не подтверждена');
////            return Redirect::back()->with('error', 'Подтвердите почту');
//        }
//    }

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::PROFILE;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        // Здесь можно добавить свою кастомную логику проверки ошибок, если это необходимо

        throw ValidationException::withMessages([
            $this->username() => [trans('Неверная почта или пароль')], // Замените 'auth.failed' на своё кастомное сообщение об ошибке
        ]);
    }
}
