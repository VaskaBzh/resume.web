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
         * btc api paths
         */
        'paths' => [
            'group' => '/groups/{group}',
            'group list' => '/worker/groups',
            'create group' => '/groups/create',
            'worker list' => '/worker',
            'update worker' => '/worker/update',
            'earn history' => '/account/earn-history',
        ],

        /**
         *  Authorization token
         */
        'token' => env('BTC_AUTH_TOKEN'),

        /**
         *  User id
         */
        'puid' => '781195',

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
         * Wait before retrying request in in microseconds
         */
        'delay_sec' => 50000,

        /**
         * Retry request if btc.com bad response with status 200
         */
        'retry_count' => 3,

        /**
         * Tax percent
         */
        'fee' => 3.5,
    ],

    'minerstat' => [
        'uri' => env('MINERSTAT_API_URI'),

        'auth' => env('MINERSTAT_API_AUTH'),

        'paths' => [
            'network_hashrate' => 'hashrate',
            'network_difficulty' => 'getdifficulty',
            'reward_block' => 'bcperblock',
            'price_USD' => '24hrprice',
        ],
    ],

    'wallet' => [
        /**
         * remote wallet ip address
         */
        'ip' => env('WALLET_ADRESS'),

        'username' => env('WALLET_USERNAME'),

        'password' => env('WALLET_PASSWORD'),

        /**
         * Authorization phrase for transaction
         */
        'walletpassphrase' => env('WALLET_PASSPHRASE'),

        /**
         * Minimal allowed withdraw for sub-account
         */
        'min_withdrawal' => env('MIN_WITHDRAWAL', 0.005),
    ],
];
