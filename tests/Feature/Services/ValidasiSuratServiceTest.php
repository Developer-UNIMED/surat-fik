<?php

namespace Services;

use App\Models\AkademikUser;
use App\Models\Role;
use App\Models\SuratMasuk;
use App\Models\User;
use App\Services\ValidasiSuratService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ValidasiSuratServiceTest extends TestCase
{
    use RefreshDatabase, WithoutModelEvents;

    private ValidasiSuratService $service;

    protected function setUp(): void
    {
        parent::setUp();
        SuratMasuk::flushEventListeners();
        $this->service = app(ValidasiSuratService::class);

        Role::factory()->create(['id' => 'ADMIN']);
        $admin = User::factory()->create(['role_id' => 'ADMIN']);

        $this->actingAs($admin)->startSession();
    }

    public function testFindAllPenerimaSuratRole()
    {
        Role::factory()->count(10)->create();

        $result = $this->service->findAllPenerimaSuratRole();
        self::assertNotEmpty($result);
        self::assertCount(10, $result);
        self::assertArrayHasKey('id', $result[0]);
        self::assertArrayHasKey('name', $result[0]);
    }

    public function testFindAllSuratMasukByRolePenerima()
    {
        $user = User::factory()->create(['role_id' => Role::factory()->create(['id' => 'USER'])->id]);
        AkademikUser::factory()->create([
            'user_id' => $user->id,
            'jurusan' => 'Penjaskes'
        ]);

        $role = Role::factory()->create([
            'id' => 'ADMIN_Penjaskes',
            'name' => 'Penjaskes',
        ]);

        SuratMasuk::factory()->count(10)->create([
            'status' => 'PENDING',
            'penerima_role_id' => $role->id,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $result = $this->service->findAllSuratMasukByRolePenerima($role);
        self::assertNotEmpty($result);
        self::assertCount(10, $result);
    }

    public function testForwardSurat()
    {
        Role::factory()->create(['id' => 'USER']);
        $wdRole = Role::factory()->create(['id' => 'WD1']);

        $user = User::factory()->create(['role_id' => 'USER']);
        $suratMasuk = SuratMasuk::factory()->create([
            'penerima_role_id' => 'ADMIN',
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $isSuccess = $this->service->forwardSurat($suratMasuk->id, $wdRole->id);
        self::assertEquals(1, $isSuccess);

        $suratMasuk = SuratMasuk::find($suratMasuk->id);
        self::assertEquals($wdRole->id, $suratMasuk->penerima_role_id);
    }

}
