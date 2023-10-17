<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    #[
        OA\Get(
            path: '/verify/{id}/{hash}',
            summary: 'Verify user\'s email address',
            tags: ['Auth'],
            parameters: [
                new OA\Parameter(
                    name: 'id',
                    description: 'User ID',
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(
                        type: 'integer'
                    )
                ),
                new OA\Parameter(
                    name: 'hash',
                    description: 'Verification hash',
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(
                        type: 'string'
                    )
                ),
            ],
            responses: [
                new OA\Response(
                    response: Response::HTTP_MOVED_PERMANENTLY,
                    description: 'Found (Redirect to the specified URL)',
                ),
                new OA\Response(
                    response: Response::HTTP_UNPROCESSABLE_ENTITY,
                    description: 'Unprocessable Entity',
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
                ),
            ]
        )
    ]
    public function __invoke(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if ($user->hasVerifiedEmail()) {
            return new JsonResponse([
                'errors' => [
                    'auth' => ['already verified']
                ]
            ], Response::HTTP_BAD_REQUEST);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect('/' . '?action=email');
    }
}
