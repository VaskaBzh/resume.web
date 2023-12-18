<?php

declare(strict_types=1);

namespace App\Console;

use App\Console\Commands\Income\IncomeCommand;
use App\Console\Commands\Income\PayoutCommand;
use App\Console\Commands\PoolStatCommand;
use App\Console\Commands\Sub\MakeHashesCommand;
use App\Console\Commands\Sub\ObserveCustomPercentTimeCommand;
use App\Console\Commands\Sub\SetSubCustomPercentCommand;
use App\Console\Commands\UpdateMinerStatCommand;
use App\Console\Commands\User\EmailVerifyNotificationCommand;
use App\Console\Commands\User\GiveRoleCommand;
use App\Console\Commands\Worker\MakeWorkerHashesCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        IncomeCommand::class,
        UpdateMinerStatCommand::class,
        MakeHashesCommand::class,
        MakeWorkerHashesCommand::class,
        PayoutCommand::class,
        GiveRoleCommand::class,
        EmailVerifyNotificationCommand::class,
        SetSubCustomPercentCommand::class,
        ObserveCustomPercentTimeCommand::class,
        PoolStatCommand::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('income')->dailyAt('07:00');
        $schedule->command('update:stats')->everyTwoHours();
        $schedule->command('sync:worker')->everyMinute();
        $schedule->command('make:worker-hashes')->everyFifteenMinutes();
        $schedule->command('observe:custom-percent-time')->dailyAt('00:00');
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
