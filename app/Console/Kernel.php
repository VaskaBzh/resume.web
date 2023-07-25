<?php

namespace App\Console;

use App\Console\Commands\UpdateHashesCommand;
use App\Console\Commands\UpdateIncomesCommand;
use App\Jobs\HourlyHashesUpdate;
use App\Jobs\UpdateWorkersHashesJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\UpdateMiningStatCommand;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        // ...
        UpdateIncomesCommand::class,
        UpdateMiningStatCommand::class,
        UpdateHashesCommand::class,
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('update:incomes')->dailyAt('5:00');
        $schedule->command('update:stats')->hourly();
        $schedule->job(new HourlyHashesUpdate())->hourly();
        $schedule->job(new UpdateWorkersHashesJob())->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
