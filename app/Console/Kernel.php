<?php

namespace App\Console;

use App\Console\Commands\MakeWorkerHashesCommand;
use App\Console\Commands\MakeHashesCommand;
use App\Console\Commands\UpdateIncomesCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\UpdateMinerStatCommand;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        UpdateIncomesCommand::class,
        UpdateMinerStatCommand::class,
        MakeHashesCommand::class,
        MakeWorkerHashesCommand::class,
    ];
    /**
     * Define the application's command schedule.
     *
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('update:incomes')->dailyAt('10:00');
        $schedule->command('update:stats')->hourly();
        $schedule->command('sync:worker')->everyMinute();
        $schedule->command('make:sub-hashes')->hourly();
        $schedule->command('make:worker-hashes')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
