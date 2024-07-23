<?php

namespace Database\Factories;

use App\Models\AkademikUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<AkademikUser>
 */
class AkademikUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => strtolower(Str::ulid()),
            'nama' => fake()->name(),
            'angkatan' => fake()->year(),
            'jenjang' => fake()->randomElement(['S1', 'S2', 'S3']),
            'program_studi' => fake()->randomElement(['Teknik Informatika', 'Sistem Informasi', 'Teknik Elektro']),
            'jurusan' => fake()->randomElement(['Teknik', 'Sistem Informasi', 'Elektro']),
            'fakultas' => fake()->randomElement(['Teknik', 'Ilmu Komputer', 'Ilmu Sosial']),
            'mobile' => '081231231231',
            'alamat' => fake()->address(),
            'tanggal_lahir' => fake()->date(),
        ];
    }
}
