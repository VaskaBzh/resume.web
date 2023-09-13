<?php

namespace App\Rules\WatcherLink;

use Illuminate\Contracts\Validation\InvokableRule;

class ContainsRouteRule implements InvokableRule
{
    private const ALLOWED_ROUTES = [
        'v1.sub.show',
        'v1.worker.show',
        'v1.worker.list',
        'v1.income.list'
    ];

   public function __invoke($attribute, $value, $fail)
   {
       if (!in_array('v1.sub.show', $value)) {
           $fail('Must contains v.sub.show route');
       }

       foreach ($value as $routeName) {
           if (!in_array($routeName, self::ALLOWED_ROUTES)) {
               $fail('This route can not be allowed');
           }
       }
   }
}
