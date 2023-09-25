<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class EmailVerifyNotificationCommand extends Command
{
    protected $signature = 'email:verify-notification';

    protected $description = 'Command description';

    public function handle(): void
    {
        $progressBar = $this->output->createProgressBar();
        $progressBar->start();

        User::all()->each(function (User $user) use ($progressBar) {

            if (!$user->hasVerifiedEmail()) {
                $progressBar->advance();
                $user->sendEmailVerificationNotification();
            }
        });

        $progressBar->finish();
    }
}
