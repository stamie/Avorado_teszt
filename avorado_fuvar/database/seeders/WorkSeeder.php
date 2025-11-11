<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('works')->insert([
            [
                'start_place' => '1035 Bp. Kiss József utca 7.',
                'end_place' => '1051 Bp. Nagy Péter utca 5.',
                'recipient_name' => 'Hajós József',
                'recipient_phone' => '+36705454111',
                'status' => 1,
                'carrier' => Vehicle::where(['licence_plate' => 'ahd-383'])->first()->id,
                'created_at' => now(),
            ],
           /* [],
            [],*/
        ]);
    }
}
