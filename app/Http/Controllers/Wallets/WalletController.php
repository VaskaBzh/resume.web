<?php

declare(strict_types=1);

namespace App\Http\Controllers\Wallets;

use App\Actions\Wallet\Upsert;
use App\Actions\Wallet\Delete;
use App\Dto\WalletData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wallet\UpsertRequest;
use App\Http\Requests\Wallet\DeleteRequest;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function create(UpsertRequest $request): JsonResponse
    {
        $walletData = WalletData::fromRequest($request->all());

        if (Wallet::isExceeded(
            groupId: $walletData->groupId,
            percent: $walletData->percent
        )) {
            return response()->json([
                'errors' => [
                    'create_error' => [trans('actions.validation_percent_exceeded')]
                ]
            ], 422);
        }

        Upsert::execute($walletData);

        return response()->json([
            'success' => [
                'create_success' => [trans('actions.wallet_create')]
            ],
        ]);
    }

    public function delete(DeleteRequest $request): JsonResponse
    {
        $walletData = WalletData::fromRequest($request->all());
        if (Wallet::isOne($walletData->groupId)) {
            return response()->json([
                'message' => trans('actions.wallet_prevent_last_delete')
            ]);
        }

        Delete::execute(
            wallet: Wallet::getByAddress(address: $walletData->walletAddress)->first()
        );

        return response()->json([
            'message' => trans('actions.wallet_delete')
        ]);
    }

    public function change(UpsertRequest $request): JsonResponse
    {
        $walletData = WalletData::fromRequest($request->all());

        if (Wallet::isExceeded(
            groupId: $walletData->groupId,
            percent: $walletData->percent
        )) {
            return response()->json([
                'errors' => [
                    'create_error' => [trans('actions.validation_percent_exceeded')]
                ]
            ], 422);
        }

        Upsert::execute($walletData);

        return response()->json([
            'success' => [
                'create_success' => [trans('actions.wallet_update')]
            ],
        ]);
    }

    public function visual(Request $request): Collection
    {
        return Wallet::getByGroupId($request->group_id)->get();
    }
}
