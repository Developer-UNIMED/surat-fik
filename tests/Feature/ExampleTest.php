<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\Remote\AkademikRemoteRepository;
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

    public function test_saja()
    {
        $repo = app(AkademikRemoteRepository::class);
        $result = $repo->findUserByNIM('4193250021');
        dd($result);
    }
}
