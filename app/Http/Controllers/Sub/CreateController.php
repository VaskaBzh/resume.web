<?php

declare(strict_types=1);

namespace App\Http\Controllers\Sub;

use App\Dto\UserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCreateRequest;
use App\Services\External\BtcComService;
use Illuminate\Http\RedirectResponse;

class CreateController extends Controller
{
    public function __invoke(
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
}
