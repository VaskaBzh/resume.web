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
        BtcComService    $btcComService,
    ): RedirectResponse
    {
        try {
            $result = $btcComService->createSub(
                userData: UserData::fromRequest(requestData: $request->all())
            );

            if (isset($result['errors'])) {
                return back()->withErrors($result['errors']);
            }

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
