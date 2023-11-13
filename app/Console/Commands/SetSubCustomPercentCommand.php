<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Sub;
use App\Models\User;
use Illuminate\Console\Command;

class SetSubCustomPercentCommand extends Command
{
    protected $signature = 'set:percent';

    protected $description = 'Command description';

    public function handle(): void
    {
        $answer = $this->choice('Find target:', ['users' => 'By users (name, email)', 'subs' => 'By subs (group_id, name)']);

        $sub = match ($answer) {
            'subs' => $this->findBySub(),
            default => $this->findByUser(),
        };

        $percent = $this->ask('percent');
        $customPercentExpiredAt = $this->ask('Specify the duration of the percentage in days');

        $confirmed = $this->confirmed(sub: $sub, percent: $percent, days: $customPercentExpiredAt);

        if ($confirmed) {
            $sub->update([
                'percent' => (float) $this->validateNumber($percent),
                'custom_percent_expired_at' => now()->addDays((int) $this->validateNumber($customPercentExpiredAt)),
            ]);
        }
    }

    private function findByUser(): Sub
    {
        $searchBy = $this->ask('name\\email');

        $subs = User::whereName($searchBy)
            ->orWhere('email', $searchBy)
            ->firstOrFail()
            ->subs()
            ->get();

        if ($subs->count() > 1) {
            $subs = $subs->where(
                'group_id',
                explode(':', $this->choice(
                    question: 'Select sub',
                    choices: $subs->map(
                        static fn ($sub) => implode(':', [$sub->sub, $sub->group_id, $sub->percent.'%'])
                    )->all(),
                    attempts: 2))[1]
            );
        }

        return $subs->firstOrFail();
    }

    private function findBySub(): Sub
    {
        $searchBy = $this->ask('name\\group_id');

        return Sub::where('sub', $searchBy)
            ->orWhere('group_id', $searchBy)
            ->firstOrFail();
    }

    private function confirmed(
        Sub $sub,
        string $percent,
        string $days
    ): bool {
        return $this->confirm('You set '.$percent.'% to sub: '.$sub->group_id.' for '.$days.' day/s');
    }

    private function validateNumber(string $number): string
    {
        if (! is_numeric($number) || $number < 0) {
            $this->error('Percent value must be unsigned int or float!');

            exit();
        }

        return $number;
    }
}
