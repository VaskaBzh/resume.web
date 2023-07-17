<?php

return [
    'btc' => [
        'uri' => env('BTC_API_URI'),
        'token' => env('BTC_AUTH_TOKEN')
    ],
    'minerstat' => [
        'uri' => env('MINERSTAT_API_URI'),
        'token' => env('MINERSTAT_API_AUTH')
    ],
];
