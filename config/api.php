<?php

return [
    'btc' => [
        'uri' => env('BTC_API_URI', false),
        'token' => env('BTC_AUTH_TOKEN', false)
    ],
    'minerstat' => env('MINERSTAT_API_URI', false),
];
