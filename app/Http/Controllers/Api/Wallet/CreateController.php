<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Wallet;

use App\Actions\User\DeleteConfirmationCode;
use App\Actions\Wallet\Create;
use App\Dto\WalletData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wallet\CreateRequest;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateController extends Controller
{
    public function __invoke(CreateRequest $request): JsonResource
    {
        Create::execute(
            walletData: WalletData::fromRequest($request->all())
        );

        DeleteConfirmationCode::execute(auth()->user());

        return new JsonResource(['message' => trans('actions.wallet_create')]);
    }
}
