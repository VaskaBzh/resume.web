<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Sub\Create;
use App\Dto\SubData;
use App\Dto\UserData;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\External\BtcComService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\ValidationException;

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
     * @param array $data
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
     */
    public function register(
        Request       $request,
        BtcComService $btcComService
    ): RedirectResponse
    {
        $this->validator($request->all())->validate();
        $userData = UserData::fromRequest($request->all());

        try {
            $isExist = $btcComService->btcHasUser(
                userData: UserData::fromRequest($request->all())
            );

            if ($isExist) {
                return back()->withErrors([
                    'name' => trans('validation.unique', ['attribute' => 'Аккаунт'])
                ]);
            }

            new Registered(
                $user = $this->create(userData: $userData)
            );
            $this->guard()->login($user);

            $btcSubAccount = $btcComService->createSub(
                userData: $userData
            );

            Create::execute(
                subData: SubData::fromRequest([
                    'user_id' => $user->id,
                    'group_id' => $btcSubAccount['gid'],
                    'userName' => $user->name,
                ])
            );
        } catch (\Exception $e) {
            report($e);
        }

        return redirect("/profile/accounts");
    }

    public function isUserAuthorizedForVerification(Request $request, User $user)
    {
        if (!hash_equals((string)$user->getKey(), (string)$request->route('id'))) {
            return false;
        }

        if (!hash_equals(sha1($user->getEmailForVerification()), (string)$request->route('hash'))) {
            return false;
        }

        return true;
    }

    public function verify(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if (!$this->isUserAuthorizedForVerification($request, $user)) {
            return abort(403, 'Unauthorized action.');
        }

        $user->markEmailAsVerified();

        return redirect($this->redirectPath())->with('message', 'Ваша почта успешно подтверждена!');
    }

    protected function messages()
    {
        if (app()->getLocale() === 'ru') {
            return [
                'password.required' => 'Поле "Пароль" обязательно для заполнения.',
                'password.min' => 'Поле "Пароль" должно быть не менее 8 символов.',
                'password.confirmed' => 'Подтверждение пароля не совпадает.',
            ];
        } else if (app()->getLocale() === 'en') {
            return [
                'password.required' => 'The "Password" field is required.',
                'password.min' => 'The "Password" field must be at least 8 characters.',
                'password.confirmed' => 'The password confirmation does not match.',
            ];
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(UserData $userData)
    {
        return User::create([
            'name' => $userData->name,
            'email' => $userData->email,
            'password' => Hash::make($userData->password),
        ]);
    }

    protected function getName(Request $request)
    {
        if (app()->getLocale() === 'ru') {
            $messages = [
                'name.required' => 'Необходимо дать имя аккаунту.',
                "name.max" => "Максимальное количество символов аккаунта 16.",
                "name.min" => "Минимальное количество символов аккаунта 3.",
            ];
        } else if (app()->getLocale() === 'en') {
            $messages = [
                'name.required' => 'Please provide an account name.',
                'name.max' => 'The maximum number of characters for the account name is 16.',
                'name.min' => 'The minimum number of characters for the account name is 3.',
            ];
        }
        $request->validate([
            'name' => 'required|min:3|max:16',
        ], $messages);

        if ($request->input("name") === "done") {
            if (app()->getLocale() === 'ru') {
                return back()->withErrors(new MessageBag(['error' => 'Аккаунт с таким именем уже существует!']));
            } else if (app()->getLocale() === 'en') {
                return back()->withErrors(new MessageBag(['error' => 'An account with this name already exists!']));
            }
        }
    }

    protected function getter(Request $request)
    {
        if (app()->getLocale() === 'ru') {
            $messages = [
                'email.required' => 'Необходимо заполнить «Email».',
                'email.email' => 'Некорректное поле «Email».',
            ];
        } else if (app()->getLocale() === 'en') {
            $messages = [
                'email.required' => 'Please fill in the "Email" field.',
                'email.email' => 'Invalid email field.',
            ];
        }
        $request->validate([
            'email' => 'required|email',
        ], $messages);
        $user = User::where('email', $request->input('email'))->first();

        if ($user) {
            if (app()->getLocale() === 'ru') {
                throw ValidationException::withMessages([
                    'error' => 'Пользователь с такой почтой уже существует.',
                ]);
            } else if (app()->getLocale() === 'en') {
                throw ValidationException::withMessages([
                    'error' => 'A user with this email already exists.',
                ]);
            }
        } else {
            if (app()->getLocale() === 'ru') {
                return back()->with('message', 'Почта доступна.');
            } else if (app()->getLocale() === 'en') {
                return back()->with('message', 'The email is available.');
            }
        }
    }
}
