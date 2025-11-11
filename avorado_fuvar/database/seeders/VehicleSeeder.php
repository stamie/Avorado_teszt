<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('vehicles')->insert([
           [
                'brand' => 'Citroen',
                'type' => 'Kisplatós',
                'licence_plate' => 'ahd-383',
                'carrier' => User::where(['name' => 'lala'])->first()->id,
           ],
           [
                'brand' => 'Peugeot',
                'type' => 'Kisplatós',
                'licence_plate' => 'ake-613',
                'carrier' => User::where(['name' => 'lala2'])->first()->id,
           ],
           [
                'brand' => 'Opel',
                'type' => 'Kisplatós',
                'licence_plate' => 'csa-103',
                'carrier' => User::where(['name' => 'lala3'])->first()->id,
           ],
           [
                'brand' => 'Opel',
                'type' => 'Nagyplatós',
                'licence_plate' => 'baba-103',
                'carrier' => User::where(['name' => 'lala5'])->first()->id,
           ],
        ]);
    }
}
