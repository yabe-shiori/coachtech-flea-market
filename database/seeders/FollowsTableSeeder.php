<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FollowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $follows = [
            ['follower_id' => 1, 'followed_id' => 2],
            ['follower_id' => 1, 'followed_id' => 3],

            ['follower_id' => 2, 'followed_id' => 1],
            ['follower_id' => 2, 'followed_id' => 3],

            ['follower_id' => 3, 'followed_id' => 1],
            ['follower_id' => 3, 'followed_id' => 2],
        ];

        DB::table('follows')->insert($follows);
    }
}
