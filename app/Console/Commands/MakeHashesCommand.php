<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions\Hashes\BulkDelete;
use App\Models\Hash;
use App\Models\Sub;
use App\Services\External\BtcComService;
use Illuminate\Console\Command;

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
        Sub::all()->each(static function(Sub $sub) use ($btcComService) {
            $hashes = Hash::oldestThan(
                groupId: $sub->group_id,
                date: now()->subMonths(2)->toDateTimeString()
            )->get();


            if ($hashes->isNotEmpty()) {
                BulkDelete::execute($hashes);
            }

            try {
                $subInfo = $btcComService->getSub($sub->group_id);

                if ($subInfo) {
                    $hashRate = $subInfo['shares_1m'];
                    $unit = $subInfo['shares_unit'];
                    $amountWorkers = $subInfo['workers_active'];
                }

                Hash::create([
                    'group_id' => $sub->group_id,
                    'hash' => $hashRate ?? 0,
                    'unit' => $unit ?? 'T',
                    'amount' => (int) $amountWorkers ?? 0,
                ]);
            } catch (\Exception $e) {
                report($e);
            }
        });
    }
}
