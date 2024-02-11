<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ItemImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $itemImages = [
            [
                'item_id' => 1,
                'image_path' => '/images/dummy1.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'item_id' => 2,
                'image_path' => '/images/dummy2.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'item_id' => 3,
                'image_path' => '/images/dummy3.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'item_id' => 4,
                'image_path' => '/images/dummy4.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'item_id' => 5,
                'image_path' => '/images/dummy5.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'item_id' => 6,
                'image_path' => '/images/dummy6.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'item_id' => 7,
                'image_path' => '/images/dummy7.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'item_id' => 8,
                'image_path' => '/images/dummy8.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'item_id' => 9,
                'image_path' => '/images/dummy9.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            
            [
                'item_id' => 10,
                'image_path' => '/images/dummy10.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($itemImages as $itemImage) {
            DB::table('item_images')->insert($itemImage);
        }
    }
}
