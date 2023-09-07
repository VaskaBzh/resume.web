<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Wallet;

use App\Actions\Wallet\Upsert;
use App\Dto\WalletData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wallet\UpdateRequest;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request): RedirectResponse
    {
        Upsert::execute(
            walletData: WalletData::fromRequest($request->all())
        );

        return back()->with('message', trans('actions.wallet_update'));
    }
}
