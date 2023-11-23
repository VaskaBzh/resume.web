<?php

namespace App\Console\Commands;

use App\Enums\User\Roles;
use App\Models\User;
use App\Services\Internal\ReferralService;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class GiveRoleCommand extends Command
{
    protected $signature = 'give:role';

    protected $description = 'Assign role by name';

    public function handle(): void
    {
        $roleName = $this
            ->choice(
                question: 'What role would you like to assign to the user?',
                choices: str_replace('referrer', 'owner', Role::pluck('name')->toArray()),
            );

        $roleName = str_replace('owner', 'referrer', $roleName);

        match ($roleName) {
            Roles::REFERRER->value => $this->createReferralProgram($roleName),
            Roles::REFERRAL->value => $this->createSpecialReferralOffer($roleName),
            default => $this->error('Wrong role')
        };
    }

    private function createReferralProgram(string $roleName)
    {
        while (true) {
            $userCredential = $this->ask(question: 'Please type owner name or email');
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
                'referral_code' => ReferralService::generateReferralCode($user),
            ];

            if ($this->confirm('Are your sure?')) {

                $user->assignRole($roleName);

                $user->update($referralProgram);

                $this->info('Referrer role has assigned to '.$user->name.'!');

                break;
            }

            $this->error('ERROR: USER NOT FOUND');
        }
    }

    public function createSpecialReferralOffer(string $roleName): void
    {
        while (true) {

            $referrers = User::role('referrer')->get();

            $formattedChoices = [];

            foreach ($referrers->toArray() as $referrer) {
                $formattedChoices[] = implode(' ', [$referrer['email'], $referrer['name']]);
            }

            $referrer = explode(' ', $this->choice(
                question: 'Please choice referrer',
                choices: $formattedChoices
            ));

            $referrer = $referrers
                ->where('email', head($referrer))
                ->first();

            $userCredential = $this->ask(question: 'Please type referral name or email');
            $referral = User::whereEmail($userCredential)
                ->orWhere('name', $userCredential)
                ->firstOrFail();

            $confirm = $this->confirm(sprintf('%s %s', $referral->email, $referral->name));

            if (! $confirm) {
                break;
            }

            $customReferralPercent = $this->ask('Enter the special referral percent');

            $referralProgram = [
                'referrer_id' => $referrer->id,
                'referral_percent' => $customReferralPercent ?? $referrer->referral_percent,
                'referral_discount' => $this->ask('Referral discount') ?? 0,
            ];

            if ($this->confirm('Are your sure?')) {

                $referral->assignRole($roleName);

                $referral->update($referralProgram);

                $this->info('Referral special offer created for '.$referral->name.'!');

                break;
            }
        }
    }
}
