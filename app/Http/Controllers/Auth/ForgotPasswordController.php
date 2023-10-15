<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    #[
        OA\Post(
            path: '/password/forgot',
            summary: 'Send password reset link to user email address',
            requestBody: new OA\RequestBody(
                required: true,
                content: [
                    new OA\JsonContent(
                        properties: [
                            new OA\Property(
                                property: 'email',
                                description: "User's email",
                                type: 'string',
                                format: 'email'
                            )
                        ]
                    )
                ]
            ),
            tags: ['Auth'],
            responses: [
                new OA\Response(
                    response: Response::HTTP_OK,
                    description: 'Password reset link sent successfully',
                    content: [
                        new OA\JsonContent(
                            properties: [
                                new OA\Property(
                                    property: 'message',
                                    description: 'Success message',
                                    type: 'string'
                                )
                            ]
                        )
                    ]
                )
            ]
        )
    ]
    public function sendLink(Request $request)
    {
        return $this->sendResetLinkEmail($request);
    }
}
