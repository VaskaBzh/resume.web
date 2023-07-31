<?php

namespace App\Http\Controllers;

use App\Services\External\BtcComService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

    public function proxy_front(Request $request, BtcComService $btcComService)
    {


        $request->validate([
            "path" => "required",
            "type" => "required",
        ]);

        return $this->proxy(
            $request->input("data"),
            $request->input("path"),
            $request->input("type")
        )->getContent();
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
