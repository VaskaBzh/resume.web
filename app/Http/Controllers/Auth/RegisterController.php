<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\MessageBag;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], $this->messages());
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);
        $user->sendEmailVerificationNotification();

        if ($request->wantsJson()) {
            return back()->with('message', 'Пользователь успешно создан!');
        }
    }

    public function verify(EmailVerificationRequest $request)
    {
        Log::channel('single')->info('Verify method called');

        $request->fulfill();

        Log::channel('single')->info('Email verification fulfilled');

        return redirect($this->redirectPath())->with('message', 'Ваша почта успешно подтверждена!');
    }

    protected function messages()
    {
        return [
            'password.required' => 'Поле "Пароль" обязательно для заполнения.',
            'password.min' => 'Поле "Пароль" должно быть не менее 8 символов.',
            'password.confirmed' => 'Подтверждение пароля не совпадает.',
        ];
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function getName(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Необходимо дать имя аккаунту.',
        ]);

        if ($request->input("name") === "done") {
            return back()->withErrors(new MessageBag(['error' => 'Аккаунт с таким именем уже существует!']));
        }
    }

    protected function getter(Request $request)
    {
        if (Auth::user()) {
            return Auth::user()->id;
        } else {
            $request->validate([
                'email' => 'required|email',
            ], [
                'email.required' => 'Необходимо заполнить «Email».',
                'email.email' => 'Некорректное поле «Email».',
            ]);
            $user = User::where('email', $request->input('email'))->first();

            if ($user) {
                throw ValidationException::withMessages([
                    'error' => 'Пользователь с такой почтой уже существует.',
                ]);
            } else {
                return back()->with('message', 'Почта доступна.');
            }
        }
    }
}
