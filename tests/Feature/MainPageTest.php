<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\MinerStat;
use Tests\TestCase;

class MainPageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_main_page()
    {
        $minerstats = MinerStat::factory()->create();
        $this->assertDatabaseHas('miner_stats', ['id' => $minerstats->only('id')]);
    }
}
