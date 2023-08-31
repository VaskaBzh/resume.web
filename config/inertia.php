<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Representing components structure
    |--------------------------------------------------------------------------
    | This structure demonstrates which component should be passed to the render method based on the request address
    |
    */

    'components' => [
        'accounts' => 'Profile/SubsPage',
        'statistic' => 'Profile/StatisticPage',
        'connecting' => 'Profile/ConnectingPage',
        'income' => 'Profile/IncomePage',
        'settings' => 'Profile/SettingsPage',
        'wallets' => 'Profile/WalletsPage',
        'workers' => 'Profile/WorkersPage',
        'about' => 'AboutPage',
        'home' => 'HomePage',
        'calculator' => 'CalculatorPage',
        'complexity' => 'ComplexityPage',
        'help' => 'FaqPage',
        'hosting' => 'HostingPage',
        'overview' => 'Profile/Referral/OverviewPage'
    ]
];
