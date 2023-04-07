<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
            return back()->withErrors(['old_password' => 'The provided password does not match your current password.'], 'changePassword');
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
            'old_password.required' => 'Please provide your old password.',
            'password.required' => 'Please provide a new password.',
            'password.confirmed' => 'The new password confirmation does not match.',
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
