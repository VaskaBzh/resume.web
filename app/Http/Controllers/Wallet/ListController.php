<?php

declare(strict_types=1);

namespace App\Http\Controllers\Wallet;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WorkerHashRate\Resources\WalletResource;
use App\Models\Sub;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ListController extends Controller
{
    public function __invoke(Sub $sub): ResourceCollection
    {
        return WalletResource::collection($sub->wallets()->get());
    }
}
