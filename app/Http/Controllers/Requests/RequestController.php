<?php

namespace App\Http\Controllers\Requests;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RequestController extends Controller
{
    public function getDifficultyData()
    {
        $response = Http::get('https://pool.api.btc.com/v1/blocks');

        if ($response->successful()) {
            return $response->json();
        }

        return response()->json(['error' => 'Failed to fetch data'], 500);
    }
    public function accountsAll()
    {
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
        $response_json = file_get_contents($req_url, false, $context);
        if(false !== $response_json) {
            try {
                return json_decode($response_json);
            } catch(Exception $e) {
                // Handle JSON parse error...
            }
        }
    }

    public function worker(Request $request)
    {
        $opts = array(
            "http" => array(
                "method" => "GET",
                "header" => "Authorization: sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N\r\n" .
                    "Content-Type: application/json; charset=utf-8",
            )
        );
        $context = stream_context_create($opts);
        $req_url = 'https://pool.api.btc.com/v1/worker?group=' . $request->input("id") . '&puid=781195';
        $response_json = file_get_contents($req_url, false, $context);
        if(false !== $response_json) {
            try {
                return json_decode($response_json);
            } catch(Exception $e) {
                // Handle JSON parse error...
            }
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
