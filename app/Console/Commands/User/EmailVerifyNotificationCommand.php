<?php

declare(strict_types=1);

namespace App\Console\Commands\User;

use App\Models\User;
use Illuminate\Console\Command;

class EmailVerifyNotificationCommand extends Command
{
    protected $signature = 'email:verify-notification';

    protected $description = 'Command description';

    public function handle(): void
    {
        $email = $this->ask(question: 'To which user would you like to send verification email?');
        $user = User::where('email', $email)
            ->firstOrFail();

        if ($user->hasVerifiedEmail()) {
            $this->error('ERROR: This user already verified!');

            exit();
        }

        $user->sendEmailVerificationNotification();

        $this->info('email send to '.$user->email.'!');
    }
}
