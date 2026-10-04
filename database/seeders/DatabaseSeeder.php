<?php

namespace Database\Seeders;

use App\Models\User;
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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Magazijn Medewerker',
            'email' => 'magazijn@test.com',
            'password' => bcrypt('password'),
            'role' => 'magazijn_medewerker',
        ]);

        User::factory()->create([
            'name' => 'Test Klant',
            'email' => 'klant@test.com',
            'password' => bcrypt('password'),
            'role' => 'klant',
        ]);
    }
}
