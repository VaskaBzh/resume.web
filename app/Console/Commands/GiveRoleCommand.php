<?php

namespace App\Console\Commands;

use App\Enums\User\Roles;
use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use App\Services\Internal\ReferralService;

class GiveRoleCommand extends Command
{
    protected $signature = 'give:role';

    protected $description = 'Command description';

    public function handle(): void
    {
        $roleName = $this
            ->choice(
                question: 'What role would you like to assign to the user?',
                choices: Role::all()->pluck('name')->toArray()
            );

        match ($roleName) {
            Roles::REFERRER->value => $this->createReferralProgram($roleName),
            Roles::REFERRAL->value => $this->createSpecialReferralOffer($roleName),
            default => $this->error('Wrong role')
        };
    }

    private function createReferralProgram(string $roleName)
    {
        while (true) {
            $userCredential = $this->ask(question: 'Please type referrer name or email');
            $user = User::where('name', $userCredential)
                ->orWhere('email', $userCredential)
                ->firstOrFail();

            if ($user->hasRole($roleName)) {
                $this->error('ERROR: This user already assigned to role!');

                break;
            }

            $referralProgram = [
                'referral_percent' => $this->ask('Referral percent'),
                'referral_discount' => $this->ask('Referral discount'),
                'referral_code' => ReferralService::generateReferralCode($user)
            ];

            if ($this->confirm('Are your sure?')) {

                $user->assignRole($roleName);

                $user->update($referralProgram);

                $this->info('Referrer role has assigned to ' . $user->name . '!');

                break;
            }

            $this->error('ERROR: USER NOT FOUND');
        }
    }

    public function createSpecialReferralOffer(string $roleName): void
    {
        while (true) {

            $referrers = User::role('referrer')->get();

            $referrerEmail = $this->choice(
                question: 'Please choice referrer',
                choices: $referrers->pluck('email')->toArray()
            );

            $userCredential = $this->ask(question: 'Please type referral name or email');
            $user = User::whereEmail($userCredential)
                ->firstOrFail();

            $referralProgram = [
                'referrer_id' => $referrers->where('email', $referrerEmail)->first()->id,
                'referral_discount' => $this->ask('Referral discount'),
            ];

            if ($this->confirm('Are your sure?')) {

                $user->assignRole($roleName);

                $user->update($referralProgram);

                $this->info('Referral special offer created for ' . $user->name . '!');

                break;
            }
        }
    }
}
