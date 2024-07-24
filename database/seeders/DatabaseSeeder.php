<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::insert([
            ['id' => 'USER', 'name' => 'USER'],
            ['id' => 'ADMIN_PJKR', 'name' => 'PEND. JASMANI, KESEHATAN DAN REKREASI'],
            ['id' => 'ADMIN_PKO', 'name' => 'PENDIDIKAN KEPELATIHAN OLAHRAGA'],
            ['id' => 'ADMIN_IKOR', 'name' => 'ILMU KEOLAHRAGAAN'],
            ['id' => 'DEKAN', 'name' => 'Dekan'],
            ['id' => 'WD1', 'name' => 'Wakil Dekan 1'],
            ['id' => 'WD2', 'name' => 'Wakil Dekan 2'],
            ['id' => 'WD3', 'name' => 'Wakil Dekan 3'],
            ['id' => 'DEV', 'name' => 'DEVELOPER'],
        ]);
    }
}
