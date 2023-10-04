<?php

namespace App\Http\Controllers\Api\Wallet;

use App\Actions\ConfirmationCode\Create;
use App\Http\Controllers\Controller;
use App\Mail\User\CodeEmail;
use App\Models\Wallet;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class SendCodeController extends Controller
{
    public function __invoke(Wallet $wallet)
    {
        $user = auth()->user();

        $this->authorize('viewOrChange', $wallet);

        $wallet->confirmationCodes()
            ->delete();

        $confirmationCode = Create::execute(
            model: $wallet,
            user: $user
        );

        Mail::to($user->email)
            ->send(new CodeEmail($confirmationCode));

        return new JsonResponse(['message' => __('auth.email.verify', ['value' => $user->email])]);
    }
}
