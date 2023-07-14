<?php

namespace App\Console;

use App\Console\Commands\SyncWorkerCommand;
use App\Console\Commands\UpdateIncomesCommand;
use App\Jobs\AddWorkerJob;
use App\Jobs\HourlyHashesUpdate;
use App\Jobs\UpdateWorkersHashesJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        // ...
        UpdateIncomesCommand::class,
        SyncWorkerCommand::class,
    ];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('update:incomes')->dailyAt('5:00');
        $schedule->command('sync:worker')->everyMinute();

//        $schedule->command('update:payments')->dailyAt('5:10');
        $schedule->job(new HourlyHashesUpdate())->hourly();
        $schedule->job(new UpdateWorkersHashesJob())->hourly();
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
