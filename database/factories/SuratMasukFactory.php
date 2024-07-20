<?php

namespace Database\Factories;

use App\Models\JenisSurat;
use App\Models\SuratMasuk;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<SuratMasuk>
 */
class SuratMasukFactory extends Factory
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
            'file_path' => fake()->filePath(),
        ];
    }
}
