<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WalletResource;
use App\Models\Sub;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WalletListController extends Controller
{
    public function __invoke(Sub $sub): ResourceCollection
    {
        return WalletResource::collection($sub->wallets()->get());
    }
}
