<?php

namespace App\Http\Controllers\Auth;

use App\Dto\UserData;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\External\BtcComService;
use App\Services\Internal\ReferralService;
use Illuminate\Auth\Events\Registered;
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
            'referral_code' => ['string', 'nullable', 'exists:users,referral_code']
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
            $user = $this->create(userData: $userData);
            auth()->login($user);
            $btcComService->createSub(userData: $userData);


            if ($request->referral_code) {
                ReferralService::attach(referral: $user, code: $request->referral_code);
            }

            event(new Registered(
                user: $user
            ));

            return new JsonResponse([
                'message' => 'success',
                'user' => new UserResource($user),
                'token' => $user->createToken(
                    $user->name,
                    ['*'],
                    now()->addMinutes(config('sanctum.expiration'))
                )->plainTextToken
            ]);
        } catch (\Exception $e) {
            report($e);

            return new JsonResponse([
                'error' => 'Something went wrong! Please contact with tech support'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    protected function messages(): array
    {
        return [
            'name.required' => __('validation.required', ['attribute' => __('validation.attributes.name')]),
            'name.regex' => __('validation.regex', ['attribute' => __('validation.attributes.name')]),
            'password.required' => __('validation.required', ['attribute' => __('validation.attributes.password')]),
            'password.min' => __('validation.min.string', [
                    'attribute' => __('validation.attributes.password'), 'min' => 8]
            ),
            'password.confirmed' => __('validation.confirmed', ['attribute' => __('validation.attributes.password')]),
            'referral_code.exists' => __('validation.exists', ['attribute' => __('validation.attributes.referral_code')])
        ];
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
}
