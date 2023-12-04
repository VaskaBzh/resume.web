<?php

declare(strict_types=1);

namespace Tests\Feature\Wallet;

use App\Mail\User\CodeEmail;
use App\Models\Sub;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class WalletTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::first();
        $this->user->markEmailAsVerified();
        Sanctum::actingAs($this->user);
    }

    /**
     * @test
     *
     * @testdox It not create wallet if code not exists
     */
    public function createWithoutCode(): void
    {
        $this->postJson(route('v1.wallet.create'), [
            'wallet_address' => Str::random(20),
            'group_id' => $this->user->subs()->first()->group_id,
            'name' => Str::random(3),
            'confirmation_code' => '54544',
        ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertExactJson([
                'message' => 'These credentials do not match our records.',
                'errors' => [
                    'confirmation_code' => ['These credentials do not match our records.'],
                ],
            ]);

        $this->assertDatabaseMissing('wallets', ['group_id' => $this->user->subs()->first()->group_id]);
    }

    /**
     * @test
     *
     * @testdox it create wallet if code passed
     */
    public function createWithCode(): void
    {
        $code = $this->generateConfirmationCode();

        $sub = $this->user->subs()->first();
        $walletAddress = Str::random(20);

        $this->postJson(route('v1.wallet.create'), [
            'wallet_address' => $walletAddress,
            'group_id' => $sub->group_id,
            'name' => Str::random(3),
            'confirmation_code' => $code,
        ])->assertCreated();

        $this->assertDatabaseHas('wallets', [
            'group_id' => $sub->group_id,
            'wallet' => $walletAddress,
            'wallet_updated_at' => null,
        ]);

        $this->assertFalse($sub->wallets()->first()->isUnlocked());
    }

    /**
     * @test
     *
     * @testdox it set delay as "wallet_updated_at" when address updated
     */
    public function updateAddress()
    {
        $sub = $this->user->subs()->first();
        $wallet = $this->createWallet($sub);

        $code = $this->generateConfirmationCode();
        $newAddress = Str::random(20);

        $this->putJson(route('v1.wallet.change.address', $wallet), [
            'wallet_address' => $newAddress,
            'confirmation_code' => $code,
        ])
            ->assertOk()
            ->assertExactJson(['message' => 'Wallet successfully updated']);

        $this->assertDatabaseHas('wallets', [
            'group_id' => $sub->group_id,
            'wallet' => $newAddress,
            'wallet_updated_at' => now(),
        ]);

        $this->assertFalse($wallet->isUnlocked());
    }

    /**
     * @test
     *
     * @testdox it unblock wallet if time delay finished
     */
    public function checkDelay()
    {
        $sub = $this->user->subs()->first();
        $wallet = $this->createWallet($sub);

        $this->assertFalse($wallet->isUnlocked());

        $wallet->update(['wallet_updated_at' => now()]);
        $this->assertFalse($wallet->isUnlocked());

        $wallet->update(['created_at' => now()->subDays(2)]);
        $this->assertFalse($wallet->isUnlocked());

        $wallet->update([
            'created_at' => now()->subDays(2),
            'wallet_updated_at' => now()->subDays(2),
        ]);
        $this->assertTrue($wallet->isUnlocked());
    }

    /**
     * @test
     *
     * @testdox it show wallet
     */
    public function show(): void
    {
        $sub = $this->user->subs()->first();
        $wallet = $this->createWallet($sub);

        $this->getJson(route('v1.wallet.list', $sub))
            ->assertOk()
            ->assertExactJson([
                'data' => [
                    [
                        'id' => $wallet->id,
                        'percent' => $wallet->percent,
                        'minWithdrawal' => $wallet->minWithdrawal,
                        'wallet' => $wallet->wallet,
                        'name' => $wallet->name,
                        'total_payout' => $wallet->total_payout,
                        'is_unlocked' => $wallet->isUnlocked(),
                    ],
                ],
            ]);
    }

    private function generateConfirmationCode(): string
    {
        Mail::fake();

        $this->postJson(route('v1.send-code', $this->user));

        $code = '';
        Mail::assertSent(CodeEmail::class, function (CodeEmail $mail) use (&$code) {
            $code = $mail->content()->with['code'];

            return $mail->hasTo($this->user->email);
        });

        $this->user->update(['confirmation_code' => Hash::make($code)]);

        return $code;
    }

    private function createWallet(Sub $sub): Wallet
    {
        $walletAddress = Str::random(20);
        $name = Str::random(5);

        return $sub->wallets()->create([
            'wallet' => $walletAddress,
            'name' => $name,
            'percent' => 100,
            'minWithdrawal' => 0.005,
        ]);
    }
}
