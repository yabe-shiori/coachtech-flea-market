<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ItemImagesTableSeeder extends Seeder
{
    public function run(): void
    {
        $itemImages = [
            [
                'item_id' => 1,
                'image_path' => 'item_images/dummy1.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'item_id' => 2,
                'image_path' => 'item_images/dummy2.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'item_id' => 3,
                'image_path' => 'item_images/dummy3.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'item_id' => 4,
                'image_path' => 'item_images/dummy4.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'item_id' => 5,
                'image_path' => 'item_images/dummy5.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'item_id' => 6,
                'image_path' => 'item_images/dummy6.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'item_id' => 7,
                'image_path' => 'item_images/dummy7.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'item_id' => 8,
                'image_path' => 'item_images/dummy8.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'item_id' => 9,
                'image_path' => 'item_images/dummy9.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'item_id' => 10,
                'image_path' => 'item_images/dummy10.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'item_id' => 11,
                'image_path' => 'item_images/dummy11.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'item_id' => 12,
                'image_path' => 'item_images/dummy12.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'item_id' => 13,
                'image_path' => 'item_images/dummy13.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'item_id' => 14,
                'image_path' => 'item_images/dummy14.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'item_id' => 15,
                'image_path' => 'item_images/dummy15.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($itemImages as $itemImage) {

            $imagePath = $itemImage['image_path'];
            $image = public_path('images/' . basename($imagePath));
            Storage::put('public/' . $imagePath, file_get_contents($image));

            DB::table('item_images')->insert($itemImage);
        }
    }
}
