<?php

namespace Database\Factories;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

class WalletFactory extends Factory
{
    protected $model = Wallet::class;

    public function definition(): array
    {
        return [
            'percent' => 100,
            'minWithdrawal' => 0.005,
            'wallet' => $this->faker->word(),
            'name' => $this->faker->name(),
            'created_at' => now(),
            'updated_at' => now(),
            'wallet_updated_at' => now(),
        ];
    }
}
