<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    /**
     * @OA\Get(
     *     path="/verify/{id}/{hash}",
     *     summary="Verify user's email address",
     *     tags={"Auth"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="hash",
     *         in="path",
     *         description="Verification hash",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="No content (Email address verified successfully)"
     *     ),
     *     @OA\Response(
     *          response=302,
     *          description="Found (Redirect to the specified URL)",
     *          @OA\Header(
     *              header="Location",
     *              description="Redirect URL",
     *              @OA\Schema(type="string")
     *          )
     *     ),
     *    @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="errors", type="object", description="Validation errors")
     *          )
     *      ),
     *    )
     */
    public function __invoke(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if ($user->hasVerifiedEmail()) {
            return  new JsonResponse(['message' => 'already verified'], 204);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect('/' . '?action=email');
    }
}
