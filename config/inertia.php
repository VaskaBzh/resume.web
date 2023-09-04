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
        'public' => [
            'about' => 'AboutPage',
            'home' => 'HomePage',
            'calculator' => 'CalculatorPage',
            'complexity' => 'ComplexityPage',
            'help' => 'FaqPage',
            'hosting' => 'HostingPage',
            'login' => 'Auth/LoginPage',
            'registration' => 'Auth/RegPage',
        ],
        'profile' => [
            'accounts' => 'Profile/SubsPage',
            'statistic' => 'Profile/StatisticPage',
            'connecting' => 'Profile/ConnectingPage',
            'income' => 'Profile/IncomePage',
            'settings' => 'Profile/SettingsPage',
            'wallets' => 'Profile/WalletsPage',
            'workers' => 'Profile/WorkersPage',
            'overview' => 'Profile/Referral/OverviewPage',
            'my-referral' => 'Profile/Referral/MyReferralPage',
            'earn-rewards' => 'Profile/Referral/EarnRewardsPage',
        ],
    ]
];
