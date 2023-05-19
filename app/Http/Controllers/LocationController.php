<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function get_location(Request $request) {
        $ip = $request->ip();

        $client = new \GuzzleHttp\Client();
        $response = $client->get("http://ip-api.com/json/{$ip}");
        $location = json_decode($response->getBody(), true);

        if (isset($location['countryCode'])) {
            return $location['countryCode']; // Возвращает двухбуквенный код страны
        } else {
            return "en";
        }
    }
}
