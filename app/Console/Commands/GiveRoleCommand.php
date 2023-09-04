<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class GiveRoleCommand extends Command
{
    protected $signature = 'give:role';

    protected $description = 'Command description';

    public function handle(): void
    {
        $roles = Role::all();

        $roleName = $this
            ->choice(
                question: 'What role would you like to assign to the user?',
                choices: $roles->pluck('name')->toArray()
            );

        while (true) {
            $userCredential = $this->ask(question: 'To which user would you like to assign this role? Please type a name or email');
            $user = User::where('name', $userCredential)
                ->orWhere('email', $userCredential)
                ->first();


            if ($user) {
                if ($user->hasRole($roleName)) {
                    $this->error('ERROR: This user already assigned to role!');

                    break;
                }
                if ($this->confirm('Are your sure? Y-y\N-n')) {
                    $user->assignRole($roleName);

                    $this->info('Referral role has assigned to ' . $user->name . '!');

                    break;
                }
            } else {
                $this->error('ERROR: USER NOT FOUND');
            }
        }
    }
}
