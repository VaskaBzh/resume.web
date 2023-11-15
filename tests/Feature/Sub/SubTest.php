<?php

declare(strict_types=1);

namespace Tests\Feature\Sub;

use App\Models\User;
use Tests\TestCase;

class SubTest extends TestCase
{
    public User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::find(3);
    }

    public function testBasic()
    {
    }
}
