<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class GuestAccessTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::first();
        $this->sub = $this->user->subs()->first();
        $this->watcherLink = User::first()
            ->watcherLinks()
            ->first();
    }

    /**
     * @test
     *
     * @testdox it show public routes to guest user
     */
    public function accessPublic(): void
    {
        $this->assertGuest();

        $this->getJson(route('v1.miner_stat'))
            ->assertOk();
        $this->getJson(route('v1.chart'))
            ->assertOk();
    }

    /**
     * @test
     *
     * @testdox it show protected routes if guest with watcher link
     */
    public function accessWithWatcherLink(): void
    {
        $this->assertGuest();

        $this->getJson(route('v1.sub.show', $this->sub))
            ->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->getJson(route('v1.sub.show', $this->sub, [
            'X-Access-Key' => 'test string',
        ]))->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->getJson(route('v1.sub.show', $this->sub), [
            'X-Access-Key' => $this->watcherLink->token,
        ])->assertOk();

        $this->getJson(route('v1.statistic.show', $this->sub), [
            'X-Access-Key' => $this->watcherLink->token,
        ])->assertOk();

        $this->getJson(route('v1.worker.list', $this->sub), [
            'X-Access-Key' => $this->watcherLink->token,
        ])->assertOk();

        $this->getJson(route('v1.income.list', $this->sub), [
            'X-Access-Key' => $this->watcherLink->token,
        ])->assertOk();

        $this->watcherLink->update(['allowed_routes' => [
            'v1.sub.show',
            'v1.statistic.show',
            'v1.worker.show',
            'v1.worker_hashrate.list',
            'v1.payout.list',
            'v1.allowed-routes',
        ]]);

        $this->getJson(route('v1.worker.list', $this->sub), [
            'X-Access-Key' => $this->watcherLink->token,
        ])->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->getJson(route('v1.income.list', $this->sub), [
            'X-Access-Key' => $this->watcherLink->token,
        ])->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
