<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions\Hashes\DeleteOldHashrates;
use App\Models\Hash;
use App\Models\Sub;
use App\Services\External\BtcComService;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class MakeHashesCommand extends Command
{
    protected $signature = 'make:sub-hashes';

    protected $description = 'Command description';

    /**
     * Записывать данные хеша
     * старые (период два месяца) удалять
     *
     */
    public function handle(
        BtcComService $btcComService
    ): void
    {
        $btcSubList  = $btcComService->filterUngrouped();
        $progress = $this->output->createProgressBar($btcSubList->count());

        $btcSubList->each(static function (array $btcSub) use ($progress) {

                $progress->start();

                if (filled($btcSub)) {
                    $localSub = Sub::find($btcSub['gid']);

                    if (!is_null($localSub) && $btcSub['workers_active'] > 0) {

                        $progress->advance();

                        DeleteOldHashrates::execute(
                            groupId: $localSub->group_id,
                            date: now()->subMonths(2)->toDateTimeString()
                        );

                        Hash::create([
                            'group_id' => $localSub->group_id,
                            'hash' => Arr::get($btcSub, 'shares_1m', 0),
                            'unit' => Arr::get($btcSub, 'shares_unit', 'T'),
                            'worker_count' => Arr::get($btcSub, 'workers_active', 0)
                        ]);
                    }
                }
            });

        $progress->finish();

        Log::channel('commands')->info('SUB HASHRATE IMPORT COMPLETE: ' . $progress->getProgress());
    }
}
