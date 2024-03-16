<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_route_pagination_home(): void
    {
        $response = $this->get('/load-more-users');
        $response->assertStatus(200);
        $this->visit('/load-more-users');
    }
}
