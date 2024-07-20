<?php

namespace Database\Factories;

use App\Models\JenisSurat;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<JenisSurat>
 */
class JenisSuratFactory extends Factory
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
            'nama_surat' => fake()->unique()->countryCode(),
            'icon_surat' => fake()->imageUrl(),
            'file_surat' => fake()->filePath(),
        ];
    }
}
