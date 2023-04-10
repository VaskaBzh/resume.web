<?php

namespace App\Console;

use App\Jobs\HourlyHashesUpdate;
use App\Jobs\UpdateWorkersHashesJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        // ...
        Commands\UpdateIncomesCommand::class,
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
//        $schedule->command('update:payments')->dailyAt('5:10');
        $schedule->job(new HourlyHashesUpdate())->hourly();
        $schedule->job(new UpdateWorkersHashesJob())->hourly();
        // $schedule->command('inspire')->hourly();
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
