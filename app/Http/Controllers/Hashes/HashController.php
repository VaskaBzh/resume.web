<?php

namespace App\Http\Controllers\Hashes;

use App\Http\Controllers\Controller;
use App\Models\Hash;
use App\Models\Sub;
use App\Models\Worker;
use Illuminate\Http\Request;


class HashController extends Controller
{
    public  function firstTickers(Worker $worker)
    {
        $opts = array(
            "http" => array(
                "method" => "GET",
                "header" => "Authorization: sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N\r\n" .
                    "Content-Type: application/json; charset=utf-8",
            )
        );
        $context = stream_context_create($opts);
        $req_url = 'https://pool.api.btc.com/v1/worker?group=' . $worker->group_id . '&puid=781195';
        $response_json = file_get_contents($req_url, false, $context);
        if (false !== $response_json) {
            try {
                $hash = Hash::all()->where('group_id', $worker->group_id)->first();
                $responseData = json_decode($response_json);
                $result = [];
                if ($responseData->data->data) {
                    $share = array_reduce($responseData->data->data, function ($carry, $item) {
                        foreach ($item as $key => $value) {
                            if ($key == "shares_1m") {
                                $carry["shares_1m"] = floatval($value);
                            }
                        }
                        return $carry["shares_1m"];}, []);
                    $unit = array_reduce($responseData->data->data, function ($carry, $item) {
                        foreach ($item as $key => $value) {
                            if ($key == "shares_unit") {
                                $carry["shares_unit"] = $value;
                            }
                        }
                        return $carry["shares_unit"];}, []);
                } else {
                    $share = 0;
                    $unit = "T";
                }

                $result[] = [
                    number_format($share, 2, ".", ""),
                    $unit
                ];

                $hash->tickers = $result;
                $hash->save();
            } catch (Exception $e) {
                // Обработка ошибки разбора JSON
                $this->release(10);
            }
        }
    }
    public function visual(Request $request)
    {
        $request->validate([
            'group_id' => 'required',
        ]);

        return Sub::all()->where('group_id', $request->input('group_id'))->first()->hashes;
    }
}
