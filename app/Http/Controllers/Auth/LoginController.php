<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Config;

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

//

    use AuthenticatesUsers;

    public function loggedOut(Request $request)
    {
        return redirect('/');
    }

    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);

        $user = auth()->getProvider()->retrieveByCredentials($credentials);

        if ($user && auth()->validate($credentials)) {
            auth()->login($user, $request->get('remember'));

            return true;
        }

        return false;
    }

    protected function verify(Request $request)
    {
        $credentials = $this->credentials($request);

        if ($this->guard()->attempt($credentials, $request->filled('remember'))) {
            $user = $this->guard()->getLastAttempted();

            $user->sendEmailVerificationNotification();
            $this->guard()->logout();

            if (app()->getLocale() === 'ru') {
                throw ValidationException::withMessages([
                    $this->username() => [trans('Сообщение с подтверждением отправлено на почту.')],
                ]);
            } else if (app()->getLocale() === 'en') {
                throw ValidationException::withMessages([
                    $this->username() => [trans('A confirmation email has been sent to your email address.')],
                ]);
            }
        }
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        // Здесь можно добавить свою кастомную логику проверки ошибок, если это необходимо
        if (app()->getLocale() === 'ru') {
            throw ValidationException::withMessages([
                $this->username() => [trans('Неверная почта или пароль.')],
            ]);
        } else if (app()->getLocale() === 'en') {
            throw ValidationException::withMessages([
                $this->username() => [trans('Invalid email or password.')],
            ]);
        }
    }
}
