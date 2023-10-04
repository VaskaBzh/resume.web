<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Wallet;

use App\Actions\Wallet\ChangeAddress;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wallet\ChangeAddressRequest;
use App\Models\Wallet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class ChangeAddressController extends Controller
{
    public function __invoke(ChangeAddressRequest $request, Wallet $wallet)
    {
        $this->authorize('viewOrChange', $wallet);

        $confirmationCode = $wallet->confirmationCodes()?->first();

        if ($request->confirmation_code !== $confirmationCode->code) {

            return new JsonResponse(
                ['message' => __('validation.custom.attribute-name.confirmation_code_exists')],
                Response::HTTP_UNPROCESSABLE_ENTITY,
            );
        }

        ChangeAddress::execute($wallet, $request->wallet_address);

        $confirmationCode->delete();

        return new JsonResource(['message' => __('actions.wallet_update')]);
    }
}
