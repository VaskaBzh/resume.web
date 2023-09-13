<?php

namespace App\Http\Controllers\Auth;

use App\Dto\UserData;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\External\BtcComService;
use App\Services\Internal\ReferralService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'regex:/^[A-aZ-z0-9]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:10', 'max:50', 'confirmed', 'regex:/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)/'],
            'referral_code' => ['string', 'nullable']
        ], $this->messages());
    }

    /**
     * Handle a registration request for the application.
     *
     */
    public function register(
        Request       $request,
        BtcComService $btcComService
    ): JsonResponse
    {
        $this->validator($request->all())->validate();

        $userData = UserData::fromRequest($request->all());

        try {
//            $btcComService->createSub(userData: $userData);

            $user = $this->create(userData: $userData);

            if ($request->referral_code) {
                ReferralService::attach(referral: $user, code: $request->referral_code);
            }

//            event(new Registered(
//                user: $user
//            ));

            return new JsonResponse([
                'message' => 'success',
                'user' => $user,
                'token' => $user->createToken($user->name)->plainTextToken
            ]);
        } catch (\Exception $e) {
            report($e);

            return new JsonResponse([
                'error' => 'Something went wrong! Please contact with tech support'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    protected function messages()
    {
        if (app()->getLocale() === 'ru') {
            return [
                'name.regex' => 'Имя должно быть на английском',
                'password.required' => 'Поле "Пароль" обязательно для заполнения.',
                'password.min' => 'Поле "Пароль" должно быть не менее 8 символов.',
                'password.confirmed' => 'Подтверждение пароля не совпадает.',
                'referral_code.exists' => 'Неверный реферральный код'
            ];
        } else if (app()->getLocale() === 'en') {
            return [
                'name.regex' => 'Name must be on english',
                'password.required' => 'The "Password" field is required.',
                'password.min' => 'The "Password" field must be at least 8 characters.',
                'password.confirmed' => 'The password confirmation does not match.',
                'referral_code.exists' => 'referral code is incorrect'
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
