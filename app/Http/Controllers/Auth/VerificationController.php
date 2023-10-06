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

    public function __invoke(Request $request, $id, $hash)
    {
        $user = User::find($id);

        if ($user->hasVerifiedEmail()) {
            return  new JsonResponse(['message' => 'already verified'], 204);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect('/' . '?action=email');
    }
}
