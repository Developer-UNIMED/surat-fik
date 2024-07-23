<?php

namespace Services;

use App\Models\JenisSurat;
use App\Models\Role;
use App\Models\User;
use App\Services\JenisSuratService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JenisSuratServiceTest extends TestCase
{
    use RefreshDatabase;

    private JenisSuratService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app(JenisSuratService::class);

        Role::factory()->create(['id' => 'ADMIN']);
        $user = User::factory()->create(['role_id' => 'ADMIN']);
        $this->actingAs($user)->startSession();
    }

    public function testFindAll()
    {
        JenisSurat::factory()->count(10)->create();

        $result = $this->service->findAll();
        $this->assertNotEmpty($result);
        $this->assertCount(10, $result);
        $this->assertArrayHasKey('id', $result[0]);
        $this->assertArrayHasKey('nama', $result[0]);
        $this->assertArrayHasKey('icon_path', $result[0]);
        $this->assertArrayHasKey('deskripsi', $result[0]);
    }

    public function testFindById()
    {
        $jenisSurat = JenisSurat::factory()->create();

        $result = $this->service->findById($jenisSurat->id);
        self::assertNotNull($result);
        self::assertArrayHasKey('id', $result);
        self::assertArrayHasKey('nama', $result);
        self::assertArrayHasKey('icon_path', $result);
        self::assertArrayHasKey('file_path', $result);
        self::assertArrayHasKey('deskripsi', $result);
    }

    public function testCreate()
    {
        $jenisSurat = JenisSurat::factory()->make()->toArray();

        $result = $this->service->create($jenisSurat);
        self::assertNotNull($result);
        self::assertIsArray($result);

        $newJenisSurat = $this->service->findById($result['id']);
        self::assertNotNull($newJenisSurat);
        self::assertEquals($jenisSurat['nama'], $newJenisSurat['nama']);
        self::assertEquals($jenisSurat['deskripsi'], $newJenisSurat['deskripsi']);
    }

    public function testUpdate()
    {
        $jenisSurat = JenisSurat::factory()->create();
        $updateData = ['nama' => 'Surat baru awik awok'];

        $result = $this->service->update($jenisSurat->id, $updateData);
        self::assertNotNull($result);
        self::assertEquals(1, $result);

        $updatedJenisSurat = $this->service->findById($jenisSurat->id);
        self::assertNotNull($updatedJenisSurat);
        self::assertNotEquals($jenisSurat->nama, $updatedJenisSurat['nama']);
        self::assertEquals($updateData['nama'], $updatedJenisSurat['nama']);
    }

    public function testDelete()
    {
        $jenisSurat = JenisSurat::factory()->create();

        $result = $this->service->delete($jenisSurat->id);
        self::assertNotNull($result);
        self::assertEquals(1, $result);
        self::assertSoftDeleted('jenis_surat', ['id' => $jenisSurat->id]);
    }
}
