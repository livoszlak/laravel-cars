<?php

namespace Database\Seeders;

use App\Models\Track;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TrackSeeder::class,
            UserSeeder::class,
            CarSeeder::class,
            LaptimeSeeder::class
        ]);
    }
}
