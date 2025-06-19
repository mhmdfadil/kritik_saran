<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nama' => 'Admin 1',
                'email' => 'admin@example.com',
                'password' => Hash::make('12345678'),
                'alamat' => 'Jl. Contoh No. 1',
                'no_hp' => '081234567890',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Admin 2',
                'email' => 'admin2@example.com',
                'password' => Hash::make('12345678'),
                'alamat' => 'Jl. Contoh No. 2',
                'no_hp' => '081298765432',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
