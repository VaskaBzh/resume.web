<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\WatcherLink;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class WatcherLinkTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::first();
        $this->user->markEmailAsVerified();
        $this->sub = $this->user->subs()->first();
        $this->watcherLink = User::first()
            ->watcherLinks()
            ->first();
        Sanctum::actingAs($this->user);
    }

    /**
     * @test
     *
     * @testdox it show creating validation errors
     */
    public function validate()
    {
        $this->postJson(route('v1.watcher.crate', $this->sub))
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors([
                'name' => 'The name field is required.',
                'allowed_routes' => 'The allowed routes field is required.',
            ]);

        $this->postJson(route('v1.watcher.crate', $this->sub), [
            'name' => 'Test',
            'allowed_routes' => ['v1.statistic.show', 'v1.worker.show'],
        ])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors([
                'allowed_routes' => 'Must contains v1.sub.show route & v1.allowed-routes',
            ]);
    }

    /**
     * @test
     *
     * @testdox it creating watcher links
     */
    public function create(): void
    {
        $token = base64_encode(json_encode([
            'name' => 'TestTwo',
            'group_id' => $this->sub->group_id,
        ]));

        $this->postJson(route('v1.watcher.crate', $this->sub), [
            'name' => 'TestTwo',
            'allowed_routes' => [
                'v1.sub.show',
                'v1.statistic.show',
                'v1.worker.show',
                'v1.worker.list',
                'v1.worker_hashrate.list',
                'v1.income.list',
                'v1.payout.list',
                'v1.allowed-routes',
            ],
        ])
            ->assertCreated()
            ->assertExactJson([
                'data' => [
                    'id' => $this->user
                        ->watcherLinks()
                        ->whereName('TestTwo')
                        ->first()
                        ->id,
                    'user_id' => $this->user->id,
                    'name' => 'TestTwo',
                    'allowed_routes' => [
                        'v1.sub.show',
                        'v1.statistic.show',
                        'v1.worker.show',
                        'v1.worker.list',
                        'v1.worker_hashrate.list',
                        'v1.income.list',
                        'v1.payout.list',
                        'v1.allowed-routes',
                    ],
                    'access_count' => null,
                    'url' => config('app.url')
                        .'/watcher?access_key='
                        .$token
                        .'&'
                        .'puid='
                        .$this->sub->group_id,
                ],
            ]);
    }

    /**
     * @test
     *
     * @testdox it update watcher link
     */
    public function update()
    {
        $this->putJson(route('v1.watcher.toggle', $this->watcherLink), [
            'name' => 'UpdatedName',
            'allowed_routes' => [
                'v1.sub.show',
                'v1.statistic.show',
                'v1.income.list',
                'v1.payout.list',
                'v1.allowed-routes',
            ],
        ])
            ->assertOk()
            ->assertExactJson(['message' => 'success']);
        $this->watcherLink->refresh();

        $this->assertEqualsCanonicalizing([
            'v1.sub.show',
            'v1.statistic.show',
            'v1.income.list',
            'v1.payout.list',
            'v1.allowed-routes',
        ], $this->watcherLink->allowed_routes);
        $this->assertEquals('UpdatedName', $this->watcherLink->name);
    }

    /**
     * @test
     *
     * @testdox it delete watcher link
     */
    public function deleteWatcher(): void
    {
        $this->deleteJson(route('v1.watcher.delete', $this->watcherLink))
            ->assertOk()
            ->assertExactJson(['message' => 'success']);

        $this->assertDatabaseMissing('watcher_links', ['id' => $this->watcherLink->id, 'group_id' => $this->watcherLink->group_id]);
    }
}
