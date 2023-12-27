<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Models\Payout;
use App\Models\Sub;
use App\Services\Internal\PayoutService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Tests\TestCase;

class PayoutServiceTest extends TestCase
{
    public Collection $subsWithHashRate;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subsWithHashRate = Sub::hasWorkerHashRate()
            ->with(['incomes'])
            ->get();

        $this->subsWithHashRate->first()->wallets()->create([
            'percent' => 100,
            'minWithdrawal' => 0.005,
            'wallet' => Str::random(20),
            'name' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'wallet_updated_at' => now(),
        ]);
    }

    /**
     * @test
     *
     * @testdox it not payout if pending amount limit not reached
     *
     * @return void
     */
    public function limitNotReached()
    {
        $this->mockRemoteWallet();

        app(PayoutService::class)->init();

        Http::assertNothingSent();
        $this->assertCount(0, Payout::all());
    }

    /**
     * @test
     *
     * @testdox it not payout if pending amount limit reached and wallet not exists
     *
     * @return void
     */
    public function walletNotExists()
    {
        $sub = $this->subsWithHashRate->first();
        $sub->update(['pending_amount' => 0.00808281]);
        $sub->wallets()->delete();

        $this->mockRemoteWallet();

        app(PayoutService::class)->init();

        Http::assertNothingSent();
        $this->assertCount(0, Payout::all());
    }

    /**
     * @test
     *
     * @testdox it not payout if pending amount limit reached and wallet just updated
     */
    public function walletOnVerify()
    {
        $sub = $this->subsWithHashRate->first();
        $sub->update(['pending_amount' => 0.00808281]);
        $sub->wallets()->first()->update([
            'created_at' => now()->subDays(2),
            'wallet_updated_at' => now(),
        ]);

        $this->mockRemoteWallet();

        app(PayoutService::class)->init();

        Http::assertNothingSent();
        $this->assertCount(0, Payout::all());
    }

    /**
     * @test
     *
     * @testdox it payout and reset pending amount
     *
     * @return void
     */
    public function payout()
    {
        $sub = $this->subsWithHashRate->first();
        $sub->update(['pending_amount' => 0.00808281]);
        $wallet = $sub->wallets()->first();
        $wallet->update([
            'created_at' => now()->subDays(2),
            'wallet_updated_at' => now()->subDays(2),
        ]);

        $this->mockRemoteWallet();

        app(PayoutService::class)->init();

        Http::assertSent(function ($request) {
            return $request->url() == 'http://92.205.163.43:8332';
        });

        $this->assertCount(1, Payout::all());
        $this->assertTrue(Sub::find($sub->group_id)->pending_amount == 0);
        $this->assertDatabaseHas('payouts', [
            'group_id' => $sub->group_id,
            'wallet_id' => $wallet->id,
            'payout' => $sub->pending_amount,
            'txid' => 'txid',
        ]);
    }

    public function mockRemoteWallet(): void
    {
        Http::fake([
            '*' => Http::response([
                'result' => 'txid',
                'error' => null,
                'id' => 'withdrawal',
            ]),
        ]);
    }
}
