<?php

use App\Models\DisposisiSurat;
use App\Models\JenisSurat;
use App\Models\Role;
use App\Models\SuratMasuk;
use App\Models\User;
use App\Repositories\Surat\SuratMasukRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SuratTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $admin = User::factory()->create([
            'name' => 'ADMIN',
            'role_id' => Role::factory()->create(['id' => 'ADMIN'])->id,
        ]);
        $pengirim = User::factory()->withRole()->create();
        $this->actingAs($pengirim)->startSession();

        $suratMasuk = SuratMasuk::factory()->count(10)->create([
            'jenis_surat_id' => JenisSurat::factory()->create(['validator_role_id' => 'ADMIN'])->id,
        ])->toArray();

        DisposisiSurat::factory()->create([
            'jenis_surat_id' => $suratMasuk[0]['jenis_surat_id'],
            'surat_masuk_id' => $suratMasuk[0]['id'],
            'pengirim_id' => $admin->id,
        ]);
    }

    public function test_get()
    {
        $repo = app(SuratMasukRepository::class);

        $result = $repo->getSuratMasukByValidatorRole(['*'], 'ADMIN');
        dd($result->toArray());
    }


}
