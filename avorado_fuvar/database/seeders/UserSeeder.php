<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'lala',
                'email' => 'lala@gmail.com',
                'password' => Hash::make('Halloka13!'),
                'role' => 'carrier',
                'created_at' => now(),
                'updated_at' => now(),

            ],    
            [
                'name' => 'lala5',
                'email' => 'lala5@gmail.com',
                'password' => Hash::make('Halloka13!'),
                'role' => 'carrier',
                'created_at' => now(),
                'updated_at' => now(),

            ],    
            [
                'name' => 'lala2',
                'email' => 'lala2@gmail.com',
                'password' => Hash::make('Halloka13!'),
                'role' => 'carrier',
                'created_at' => now(),
                'updated_at' => now(),

            ],    
            [
                'name' => 'lala3',
                'email' => 'lala3@gmail.com',
                'password' => Hash::make('Halloka13!'),
                'role' => 'carrier',
                'created_at' => now(),
                'updated_at' => now(),

            ],    
            [
                'name' => 'lala4',
                'email' => 'lala4@gmail.com',
                'password' => Hash::make('Halloka13!'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),

            ],    
        ]);
    }
}
