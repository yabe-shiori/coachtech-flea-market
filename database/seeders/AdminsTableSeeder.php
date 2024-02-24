<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name' => '管理太郎',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
