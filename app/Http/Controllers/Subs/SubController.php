<?php

declare(strict_types=1);

namespace App\Http\Controllers\Subs;

use App\Actions\Sub\Create;
use App\Dto\SubData;
use App\Dto\UserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCreateRequest;
use App\Services\External\BtcComService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;

class SubController extends Controller
{
    public function create(
        SubCreateRequest $request,
        BtcComService $btcComService,
    ): RedirectResponse
    {
        $userData = UserData::fromRequest(
            requestData: $request->all()
        );

        try {
            $isExists = $btcComService->btcHasUser(
                userData: $userData
            );

            if ($isExists) {
                return back()->withErrors([
                    'name' => trans('validation.unique', ['attribute' => 'Аккаунт'])
                ]);
            }

            $btcSub = $btcComService->createSub(userData: $userData);

            Create::execute(
                subData: SubData::fromRequest([
                    'user_id' => auth()->user()->id,
                    'group_id' => $btcSub['gid'],
                    'group_name' => $userData->name,
                ])
            );
        } catch (\Exception $e) {
            report($e);

            return back()->with([
                'message' => trans('actions.fail_sub_create')
            ]);
        }

        return back()->with([
            'message' => trans('actions.success_sub_create')
        ]);
    }

    public function visual(): Collection
    {
        return auth()
            ->user()
            ->subs;
    }
}
