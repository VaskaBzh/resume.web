<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Wallet;

use App\Http\Controllers\Controller;
use App\Http\Resources\WalletResource;
use App\Models\Sub;
use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ListController extends Controller
{
    public function __invoke(Sub $sub): ResourceCollection
    {
        $this->authorize('viewOrChange', $sub);

        return WalletResource::collection($sub->wallets()->get());
    }
}
