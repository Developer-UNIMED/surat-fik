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
            'nama' => fake()->unique()->countryCode(),
            'icon_path' => fake()->imageUrl(),
            'file_path' => fake()->filePath(),
            'deskripsi' => fake()->text(),
        ];
    }
}
