<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Wallet;

use App\Actions\Wallet\Update;
use App\Dto\WalletData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wallet\UpdateRequest;
use App\Models\Wallet;
use App\Policies\WalletPolicy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Wallet $wallet): JsonResource
    {
        $this->authorize('viewOrChange', $wallet);

        Update::execute(
            walletData: WalletData::fromRequest($request->all()),
            wallet: $wallet,
        );

        return new JsonResource(['message' => trans('actions.wallet_update')]);
    }
}
