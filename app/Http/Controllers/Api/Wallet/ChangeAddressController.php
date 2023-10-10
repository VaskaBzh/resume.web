<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Wallet;

use App\Actions\Wallet\ChangeAddress;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wallet\ChangeAddressRequest;
use App\Models\Wallet;
use Illuminate\Http\Resources\Json\JsonResource;

class ChangeAddressController extends Controller
{
    public function __invoke(ChangeAddressRequest $request, Wallet $wallet)
    {
        $this->authorize('viewOrChange', $wallet);

        if (!ChangeAddress::execute($wallet, $request->wallet_address)) {
            return new JsonResource(['message' => __('actions.failed')]);
        }

        return new JsonResource(['message' => __('actions.wallet_update')]);
    }
}
