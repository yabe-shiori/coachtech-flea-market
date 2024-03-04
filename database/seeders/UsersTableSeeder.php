<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'テスト太郎',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'invitation_code' => 'xIth3z3z',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'テスト次郎',
            'email' => 'testjiro@example.com',
            'password' => Hash::make('password'),
            'invitation_code' => 'jf9Ofi32',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'テスト三郎',
            'email' => 'testsaburo@example.com',
            'password' => Hash::make('password'),
            'invitation_code' => 'Lo458ikg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
