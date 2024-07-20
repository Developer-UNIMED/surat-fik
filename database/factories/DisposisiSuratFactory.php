<?php

namespace Database\Factories;

use App\Models\DisposisiSurat;
use App\Models\JenisSurat;
use App\Models\SuratMasuk;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<DisposisiSurat>
 */
class DisposisiSuratFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => strtolower(Str::ulid()),
            'jenis_surat_id' => JenisSurat::factory()->create()->id,
            'surat_masuk_id' => SuratMasuk::factory()->create()->id,
            'pengirim_id' => User::factory()->withRole()->create()->id,
            'penerima_id' => User::factory()->withRole()->create()->id,
            'status' => fake()->randomElement(['Diteruskan', 'Ditolak', 'Diarsipkan']),
            'catatan' => fake()->text(),
        ];
    }
}
