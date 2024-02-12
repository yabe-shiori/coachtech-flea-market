<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'テスト太郎',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'avatar' => '/images/user-default.jpg',
            'postal_code' => '1234567',
            'address' => '東京都渋谷区',
            'building_name' => '渋谷ビル',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
