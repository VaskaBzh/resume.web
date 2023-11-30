<?php

declare(strict_types=1);

namespace Tests;

use App\Models\MinerStat;
use Database\Seeders\RoleAndPermissionsSeeder;
use Database\Seeders\TestingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    public MinerStat $stat;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndPermissionsSeeder::class);
        $this->seed(TestingSeeder::class);
        $this->stat = MinerStat::first();
    }
}
