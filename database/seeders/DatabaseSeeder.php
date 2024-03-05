<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            ProfilesTableSeeder::class,
            CategoriesTableSeeder::class,
            BrandsTableSeeder::class,
            ItemsTableSeeder::class,
            ItemImagesTableSeeder::class,
            SoldItemsTableSeeder::class,
            FavoritesTableSeeder::class,
            CommentsTableSeeder::class,
            AdminsTableSeeder::class,
            FollowsTableSeeder::class,
            RatingsTableSeeder::class,
        ]);
    }
}
