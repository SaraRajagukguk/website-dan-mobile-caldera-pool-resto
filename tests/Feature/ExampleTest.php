<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\Concerns\BuildsPromoDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use BuildsPromoDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $this->buildPromoDatabase();
        Http::preventStrayRequests();
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
