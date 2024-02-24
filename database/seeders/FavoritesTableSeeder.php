<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Favorite;

class FavoritesTableSeeder extends Seeder
{
    public function run(): void
    {
        Favorite::create([
            'user_id' => 1,
            'item_id' => 2,
        ]);

        Favorite::create([
            'user_id' => 1,
            'item_id' => 3,
        ]);

        Favorite::create([
            'user_id' => 1,
            'item_id' => 5,
        ]);

        Favorite::create([
            'user_id' => 1,
            'item_id' => 6,
        ]);

        Favorite::create([
            'user_id' => 2,
            'item_id' => 1,
        ]);

        Favorite::create([
            'user_id' => 1,
            'item_id' => 3,
        ]);

        Favorite::create([
            'user_id' => 1,
            'item_id' => 4,
        ]);

        Favorite::create([
            'user_id' => 1,
            'item_id' => 5,
        ]);
    }
}
