<?php

declare(strict_types=1);

namespace App\Console;

use App\Console\Commands\EmailVerifyNotificationCommand;
use App\Console\Commands\GiveRoleCommand;
use App\Console\Commands\IncomeCommand;
use App\Console\Commands\MakeWorkerHashesCommand;
use App\Console\Commands\MakeHashesCommand;
use App\Console\Commands\PayoutCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\UpdateMinerStatCommand;

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
    ];
    /**
     * Define the application's command schedule.
     *
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('income')->dailyAt('07:00');
        $schedule->command('update:stats')->everyTwoHours();
        $schedule->command('sync:worker')->everyMinute();
        $schedule->command('make:worker-hashes')->everyThirtyMinutes();
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
