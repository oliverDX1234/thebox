<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->withoutMiddleware();
        $response = $this->get('/api/packages?categories=5&statuses=Active&discounts=No+Discount');

        $response->assertStatus(200);
    }
}
