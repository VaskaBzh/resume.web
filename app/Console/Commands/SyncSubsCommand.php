<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Sub;
use App\Services\External\BtcComService;
use Illuminate\Console\Command;

class SyncSubsCommand extends Command
{
    protected $signature = 'sync:subs';

    protected $description = 'Command description';

    public function handle(BtcComService $btcComService): void
    {
        $btcSubsCollection = $btcComService->filterUngrouped();
        
        $deletedCount = Sub::whereNotIn('group_id', $btcSubsCollection->pluck('gid')->toArray())
            ->delete();

        info('deleted subs', [
            'count' => $deletedCount
        ]);
    }
}
