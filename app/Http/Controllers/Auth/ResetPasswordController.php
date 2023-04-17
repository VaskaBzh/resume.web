<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class ResetPasswordController extends Controller
{
    /**
     * Where to redirect users after changing their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::PROFILE;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form to change the user's password.
     *
     * @return string
     */
    public function showChangePasswordForm()
    {
        return "/profile/settings";
    }

    /**
     * Handle the password change request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request)
    {
        $this->validateWithBag('changePassword', $request, $this->rules(), $this->customErrorMessages());

        $user = auth()->user();

        if (!Hash::check($request->input('old_password'), $user->password)) {
            $validator = Validator::make([], []);
            $validator->errors()->add('old_password', 'Необходимо подтвердить старый пароль');
            return back()->with(['errorBags' => ['changePassword' => $validator->errors()]])->withErrors($validator, 'changePassword');
        }

        $this->resetPassword($user, $request->input('password'));

        return redirect($this->redirectTo);
    }

    /**
     * Get the password change validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'old_password' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    /**
     * Get the custom error messages.
     *
     * @return array
     */
    protected function customErrorMessages()
    {
        return [
            'old_password.required' => 'Введите старый пароль',
            'password.required' => 'Введите новый пароль',
            'password.confirmed' => 'Подтвердите пароль',
            'password.min' => 'Новый пароль должен содержать минимум 8 символов.',
        ];
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        // You may also dispatch an event for password change here, if needed.
    }
}
