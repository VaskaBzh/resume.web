<?php

return [
    'btc' => [
        'uri' => env('BTC_API_URI'),
        'token' => env('BTC_AUTH_TOKEN'),
    ],
    'minerstat' => [
        'uri' => env('MINERSTAT_API_URI'),
        'token' => env('MINERSTAT_API_AUTH'),
    ],
    'wallet' => [
        'ip' => env('WALLET_ADRESS'),
        'username' => env('WALLET_USERNAME'),
        'password' => env('WALLET_PASSWORD'),
        'walletpassphrase' => env('WALLET_PASSPHRASE'),
    ]
];
