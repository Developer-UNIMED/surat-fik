<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
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
        $this->actingAs($admin)->startSession();
    }

    public function test_create()
    {
        // do post request to admin.jenis-surat.store
        $response = $this->post(route('admin.jenis-surat.store'), [
            'nama' => 'Surat Test',
            'icon' => UploadedFile::fake()->image('icon.png'),
            'file' => UploadedFile::fake()->create('file.pdf'),
            'deskripsi' => 'Deskripsi Surat Test',
        ])->assertStatus(200);
        dd($response->json());
    }

}
