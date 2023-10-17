<?php

namespace App\Http\Controllers\Auth;

use App\Dto\UserData;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Rules\User\OnlyEngNameRule;
use App\Services\External\BtcComService;
use App\Services\Internal\ReferralService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

class RegisterController extends Controller
{
    use RegistersUsers;

    #[
        OA\Post(
            path: '/register',
            summary: 'Register a user',
            requestBody: new OA\RequestBody(
                description: 'Request body for user registration',
                required: true,
                content: [
                    new OA\JsonContent(
                        required: [
                            'name',
                            'email',
                            'password',
                            'password_confirmation',
                        ],
                        properties: [
                            new OA\Property(
                                property: 'name',
                                type: 'string',
                            ),
                            new OA\Property(
                                property: 'email',
                                type: 'string',
                                format: 'email',
                            ),
                            new OA\Property(
                                property: 'password',
                                type: 'string',
                                maxLength: 50,
                                minLength: 10,
                            ),
                            new OA\Property(
                                property: 'password_confirmation',
                                type: 'string',
                                maxLength: 50,
                                minLength: 10,
                            ),
                            new OA\Property(
                                property: 'referral_code',
                                type: 'string',
                            ),
                        ],
                        type: 'object',
                    ),
                ],
            ),
            tags: ['Auth'],
            responses: [
                new OA\Response(
                    response: Response::HTTP_OK,
                    description: 'User registered successfully',
                    content: [
                        new OA\JsonContent(
                            properties: [
                                new OA\Property(
                                    property: 'message',
                                    type: 'string',
                                ),
                                new OA\Property(
                                    property: 'user',
                                    ref: '#/components/schemas/UserResource',
                                ),
                                new OA\Property(
                                    property: 'token',
                                    type: 'string',
                                ),
                            ],
                            type: 'object',
                        ),
                    ],
                ),
                new OA\Response(
                    response: Response::HTTP_UNPROCESSABLE_ENTITY,
                    description: 'Validation error',
                    content: [
                        new OA\JsonContent(
                            type: 'object',
                            example: [
                                'errors' => [
                                    'property' => ['message']
                                ]
                            ]
                        ),
                    ],
                )
            ],
        )
    ]
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
                'errors' => [
                    'auth' => ['Something went wrong! Please contact with tech support']
                ]
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
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
            'name' => ['required', 'string', 'max:255', new OnlyEngNameRule, 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:10', 'max:50', 'confirmed', 'regex:/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)/'],
            'referral_code' => ['string', 'nullable', 'exists:users,referral_code']
        ], $this->messages());
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
            'name.min' => __('validation.min.string', [
                    'attribute' => __('validation.attributes.name'), 'min' => 8]
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
