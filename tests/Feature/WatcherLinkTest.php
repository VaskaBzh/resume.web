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
    public function create()
    {
        $token = base64_encode(json_encode([
            'name' => 'Test',
            'group_id' => $this->sub->group_id,
        ]));

        $this->postJson(route('v1.watcher.crate', $this->sub), [
            'name' => 'Test',
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
                    'id' => 1,
                    'user_id' => $this->user->id,
                    'name' => 'Test',
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
        $watcher = $this->createWatcherLink();

        $this->putJson(route('v1.watcher.toggle', $watcher), [
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
        $watcher->refresh();

        $this->assertEqualsCanonicalizing([
            'v1.sub.show',
            'v1.statistic.show',
            'v1.income.list',
            'v1.payout.list',
            'v1.allowed-routes',
        ], $watcher->allowed_routes);
        $this->assertEquals('UpdatedName', $watcher->name);
    }

    /**
     * @test
     *
     * @testdox it delete watcher link
     */
    public function deleteWatcher(): void
    {
        $watcher = $this->createWatcherLink();
        $this->deleteJson(route('v1.watcher.delete', $watcher))
            ->assertOk()
            ->assertExactJson(['message' => 'success']);

        $this->assertDatabaseMissing('watcher_links', ['id' => $watcher->id, 'group_id' => $watcher->group_id]);
    }

    private function createWatcherLink(): WatcherLink
    {
        return $this->sub->watcherLinks()->create([
            'name' => 'Test',
            'user_id' => $this->user->id,
            'token' => base64_encode(json_encode([
                'name' => 'Test',
                'group_id' => $this->sub->group_id,
            ])),
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
        ]);
    }
}
