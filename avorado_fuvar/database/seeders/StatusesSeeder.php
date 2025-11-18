<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('statuses')->truncate();   
        DB::table('statuses')->insert([
            ['id' => 1, 'name' => 'Kiosztva'],
            ['id' => 2, 'name' => 'Folyamatban'],
            ['id' => 3, 'name' => 'Elvégezve'],
            ['id' => 4, 'name' => 'Sikertelen'],
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('statuses')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
