<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes as OA;

#[
    OA\Info(
        version: "1.0.0",
        description: "Документация OpenApi для Allbtc pool",
        title: "Allbtc Swagger UI"
    ),
    OA\Contact(email: 'ognevoy.bima@gmail.com'),
]
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
