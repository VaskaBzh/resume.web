<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Api
    |--------------------------------------------------------------------------
    |
    | This structure defines authorization tokens and API addresses that our application interacts with,
    | as specified in the environment variables
    |
    */

    'btc' => [
        /**
         *  btc api url
         */
        'url' => 'https://pool.api.btc.com/v1',

        /**
         *  Authorization token
         */
        'token' => env('BTC_AUTH_TOKEN'),

        /**
         *  User id
         */
        'puid' => 781195,

        /**
         * Before grouped workers connected on buffer group
         */
        'ungrouped_id' => -1,

        /**
         * Contains all grouped workers
         */
        'all_groups' => 0,

        'default_page_size' => 1000,

        /**
         * Wait before retrying request
         */
        'delay_sec' => 1,

        /**
         * Retry request if btc.com bad response with status 200
         */
        'retry_count' => 3,

        /**
         * Tax percent
         */
        'fee' => 0.5,
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
    ],
];
