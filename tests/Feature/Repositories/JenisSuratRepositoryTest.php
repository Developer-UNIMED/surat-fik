<?php

namespace Repositories;

use App\Models\JenisSurat;
use App\Models\User;
use App\Repositories\JenisSuratRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JenisSuratRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private JenisSuratRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = app(JenisSuratRepository::class);

        $user = User::factory()->withRole()->create();
        $this->actingAs($user)->startSession();
    }

    public function testCreate()
    {
        $mock = JenisSurat::factory()->make()->toArray();
        $jenisSurat = $this->repository->create($mock);

        self::assertNotNull($jenisSurat);
        self::assertEquals($mock['id'], $jenisSurat->id);
    }
}
