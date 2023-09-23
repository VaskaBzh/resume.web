<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MainRoutesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_main_page()
    {
        $this->get(route('home'))
            ->assertOk();
    }

    public function test_hosting_page()
    {
        $this->get(route('hosting'))
            ->assertOk();
    }

    public function test_help_page()
    {
        $this->get(route('help'))
            ->assertOk();
    }
}