<?php

namespace App\Http\Controllers\Requests;

use App\Services\External\BtcComService;
use App\Services\Internal\IncomeService;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class RequestController extends Controller
{
    private $apiUrl = 'https://pool.api.btc.com/v1';

    public function proxy($data, $path, $type = "get")
    {
        $url = $this->apiUrl . '/' . $path . '?' . http_build_query($data);
        if ($type === "get") {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json; charset=utf-8',
                'Authorization' => 'sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N',
            ])->get($url);
        } else {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json; charset=utf-8',
                'Authorization' => 'sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N',
            ])->post($url, $data);
        }

        return response($response->body())
            ->header('Content-Type', 'application/json')
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, PUT, POST, DELETE, HEAD, OPTIONS')
            ->header('Access-Control-Allow-Credentials', 'true');
    }

    public function proxy_front(
        Request $request,
        BtcComService $btcComService,
    )
    {
dd($request->all());
        $request->validate([
            "path" => "required",
            "type" => "required",
        ]);

        $result = IncomeService::buildWithParams(
            params: $btcComService->getEarnHistory()['list']
        );

        return new JsonResponse([
            'data' => $btcComService->call(
                segments: explode('/', $request->path),
                method: $request->type,
                params: $request->data,
            )
        ]);
    }

    public function proxy_diff(Request $request)
    {
        $request->validate([
            "path" => "required",
            "type" => "required",
        ]);

        $url = $request->input("path") . '?' . http_build_query($request->input("data"));
        if ($request->input("type") === "get") {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json; charset=utf-8',
            ])->get($url);
        } else {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json; charset=utf-8',
            ])->post($url, $request->input("data"));
        }

        return response($response->body())
            ->header('Content-Type', 'application/json')
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, PUT, POST, DELETE, HEAD, OPTIONS')
            ->header('Access-Control-Allow-Credentials', 'true')
            ->getContent();
    }
}
