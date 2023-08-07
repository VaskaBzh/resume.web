<?php

declare(strict_types=1);

namespace App\Http\Controllers\Wallet;

use App\Actions\Wallet\Upsert;
use App\Dto\WalletData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wallet\CreateRequest;
use Illuminate\Http\RedirectResponse;

class CreateController extends Controller
{
    public function __invoke(CreateRequest $request): RedirectResponse
    {
        $walletData = WalletData::fromRequest($request->all());

        Upsert::execute($walletData);

        return back()->with('message', trans('actions.wallet_create'));
    }
}
