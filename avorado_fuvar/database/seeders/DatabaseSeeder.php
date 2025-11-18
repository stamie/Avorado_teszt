<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Vehicle;
use App\Models\Work;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            StatusesSeeder::class,
            UserSeeder::class, 
            VehicleSeeder::class, 
            WorkSeeder::class,
        
        ]);
    }
}
