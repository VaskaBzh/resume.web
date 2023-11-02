<?php

namespace App\Console\Commands;

use App\Enums\User\Roles;
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

        match ($roleName) {
            Roles::REFERRER->value => $this->createReferral($roleName),
            default => $this->error('Wrong role')
        };
    }

    private function createReferral(string $roleName)
    {
        while (true) {
            $userCredential = $this->ask(question: 'To which user would you like to assign referrer role? Please type a name or email');
            $user = User::where('name', $userCredential)
                ->orWhere('email', $userCredential)
                ->firstOrFail();

            if ($user->hasRole($roleName)) {
                $this->error('ERROR: This user already assigned to role!');

                break;
            }

            $referralPercent = $this->ask('Referral percent:');
            $referralDiscount = $this->ask('Referral discount:');

            if ($this->confirm('Are your sure? Y-y\N-n')) {

                $user->assignRole($roleName);

                $user->update([
                    'referral_percent' => $referralPercent,
                    'referral_discount' => $referralDiscount,
                ]);

                $this->info('Referrer role has assigned to ' . $user->name . '!');

                break;
            }

            $this->error('ERROR: USER NOT FOUND');
        }
    }
}
