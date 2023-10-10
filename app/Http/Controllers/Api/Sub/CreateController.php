<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Sub;

use App\Dto\UserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCreateRequest;
use App\Services\External\BtcComService;
use Illuminate\Http\JsonResponse;

class CreateController extends Controller
{
    public function __invoke(
        SubCreateRequest $request,
        BtcComService    $btcComService,
    ): JsonResponse
    {
        try {
            $result = $btcComService->createSub(
                userData: UserData::fromRequest(requestData: $request->all())
            );

            if (isset($result['errors'])) {
                return new JsonResponse(['error' => $result['errors']]);
            }

        } catch (\Exception) {
            return new JsonResponse([
                'error' => __('actions.fail_sub_create')
            ]);
        }
        return new JsonResponse([
            'message' => __('actions.success_sub_create')
        ]);
    }
}
