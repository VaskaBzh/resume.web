<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Wallet;

use App\Actions\Wallet\Upsert;
use App\Dto\WalletData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wallet\CreateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateController extends Controller
{
    public function __invoke(CreateRequest $request): JsonResource
    {
        $walletData = WalletData::fromRequest($request->all());

        Upsert::execute($walletData);

        return new JsonResource(['message' => trans('actions.wallet_create')]);
    }
}
