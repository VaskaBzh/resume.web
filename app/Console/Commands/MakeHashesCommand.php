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
        $progress = $this->output->createProgressBar();

        Sub::hasWorkerHashRate()->each(static function (Sub $sub) use ($btcComService, $progress) {
            $progress->advance();

            DeleteOldHashrates::execute(
                groupId: $sub->group_id,
                date: now()->subMonths(2)->toDateTimeString()
            );

            try {
                $subInfo = $btcComService->getSub($sub->group_id);

                Hash::create([
                    'group_id' => $sub->group_id,
                    'hash' => Arr::get($subInfo, 'shares_1m', 0),
                    'unit' => Arr::get($subInfo, 'shares_unit', 'T'),
                    'worker_count' => Arr::get($subInfo, 'workers_active', 0)
                ]);
            } catch (\Exception $e) {
                report($e);
            }
        });

        $progress->finish();

        Log::channel('commands')->info('SUB HASHRATE IMPORT COMPLETE');
    }
}
