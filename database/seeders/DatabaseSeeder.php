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
            ['id' => 'ADMIN', 'name' => 'ADMIN'],
            ['id' => 'DEV', 'name' => 'DEVELOPER'],
        ]);
    }
}
