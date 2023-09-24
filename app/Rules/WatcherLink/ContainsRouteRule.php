<?php

namespace App\Rules\WatcherLink;

use Illuminate\Contracts\Validation\InvokableRule;

class ContainsRouteRule implements InvokableRule
{
    private const ALLOWED_ROUTES = [
        'v1.sub.show',
        'v1.hashrate.list',
        'v1.worker.show',
        'v1.worker.list',
        'v1.worker_hashrate.list',
        'v1.income.list',
        'v1.payout.list'
    ];

   public function __invoke($attribute, $value, $fail)
   {
       if (!in_array('v1.sub.show', $value) || !in_array('v1.allowed-routes', $value)) {
           $fail('Must contains v.sub.show route');
       }

       foreach ($value as $routeName) {
           if (!in_array($routeName, self::ALLOWED_ROUTES)) {
               $fail('This route can not be allowed');
           }
       }
   }
}
