<?php

namespace App\Http\Controllers\Requests;

use Exception;
use App\Http\Controllers\Controller;
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

    public function proxy_front(Request $request)
    {
        $request->validate([
           "data" => "required",
           "path" => "required",
           "type" => "required",
        ]);

        return $this->proxy($request->input("data"), $request->input("path"), $request->input("type"))->getContent();
    }

    public function getDifficultyData()
    {
        $response = Http::get('https://api.blockchain.info/charts/difficulty?format=json&timespan=all');

        if ($response->successful()) {
            return $response->json();
        }

        return response()->json(['error' => 'Failed to fetch data'], 500);
    }
    public function accountsAll()
    {
        $data = Cache::remember('accountsAll', 60, function () {
            // Create a stream
            $opts = array(
                "http" => array(
                    "method" => "GET",
                    "header" => "Authorization: sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N\r\n" .
                        "Content-Type: application/json; charset=utf-8",
                )
            );
            $context = stream_context_create($opts);
            $req_url = 'https://pool.api.btc.com/v1/worker/groups?puid=781195&page=1&page_size=52';
            $response_json = @file_get_contents($req_url, false, $context);
            if(false !== $response_json) {
                try {
                    return json_decode($response_json);
                } catch(Exception $e) {
                    // Handle JSON parse error...
                    return ['error' => 'Failed to parse JSON'];
                }
            } else {
                return ['error' => 'Failed to fetch data'];
            }
        });

        return response()->json($data);
    }

    public function worker(Request $request)
    {
        //if ($request->header('X-CSRF-TOKEN') != csrf_token()) {
        //    return response()->json(['message' => 'CSRF token mismatch.'], 403);
        //}
        $client = new Client([
            'base_uri' => 'https://pool.api.btc.com/v1/',
            'headers' => [
                'Authorization' => 'sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N',
                'Content-Type' => 'application/json; charset=utf-8'
            ]

        ]);
        try {
            $response = $client->get('worker', [
                'query' => [
                    'group' => $request->input("id"),
                    'status' => "all",
                    'puid' => '781195'
                ]
            ]);

            if ($response->getStatusCode() == 200) {
                $responseJson = json_decode($response->getBody());
                return $responseJson;
            }
        } catch (Exception $e) {
            // Handle error...
        }
    }

    public function earn_list()
    {
        $opts = array(
            "http" => array(
                "method" => "GET",
                "header" => "Authorization: sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N\r\n" .
                    "Content-Type: application/json; charset=utf-8",
            )
        );
        $context = stream_context_create($opts);
        $req_url = 'https://pool.api.btc.com/v1/account/earn-history?puid=781195&page=1&page_size=100';
        $response_json = file_get_contents($req_url, false, $context);
        if(false !== $response_json) {
            try {
                return json_decode($response_json);
            } catch(Exception $e) {
                // Handle JSON parse error...
            }
        }
    }

//    public function worker_update(Request $request)
//    {
//        $context = stream_context_create(
//            array(
//                "http" => array(
//                    "method" => "POST",
//                    "header" => "Authorization: sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N\r\n" .
//                        "Content-Type: application/json; charset=utf-8\r\n" .
//                        "Accept: application/json\r\n" .
//                    "Access-Control-Allow-Methods: GET, PUT, POST, DELETE, HEAD, OPTIONS\r\n" .
//                    "Access-Control-Allow-Credentials: true\r\n" . PHP_EOL,
//                    "content" => $request->input("data")->query(),
//                )
//            )
//        );
//        $req_url = "https://pool.api.btc.com/v1/worker/update";
//        $response_json = file_get_contents($req_url, false, $context);
//        if (false !== $response_json) {
//            try {
//                return json_decode($response_json);
//            } catch(Exception $e) {
//                // Handle JSON parse error...
//            }
//        }
//    }

    public function history(Request $request)
    {
        $opts = array(
            "http" => array(
                "method" => "GET",
                "header" => "Authorization: sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N\r\n" .
                    "Content-Type: application/json; charset=utf-8",
            )
        );
        $context = stream_context_create($opts);
        $req_url = 'https://pool.api.btc.com/v1/worker/' . $request->input("workerId") . '/share-history?puid=781195&dimension=1' . $request->input("unit") . '&start_ts=' . $request->input("time") . '&count=100';
        $response_json = file_get_contents($req_url, false, $context);
        if(false !== $response_json) {
            try {
                return json_decode($response_json);
            } catch(Exception $e) {
                // Handle JSON parse error...
            }
        }
    }
}
