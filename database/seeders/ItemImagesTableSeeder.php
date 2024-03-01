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
        $dummyImages = [];
        for ($i = 1; $i <= 15; $i++) {
            $dummyImages[] = 'dummy' . $i . '.png';
        }

        for ($itemId = 1; $itemId <= 15; $itemId++) {
            $selectedImages = array_rand($dummyImages, 5);
            foreach ($selectedImages as $index) {
                $imagePath = 'item_images/' . $dummyImages[$index];
                $itemImage = [
                    'item_id' => $itemId,
                    'image_path' => $imagePath,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                $image = public_path('images/' . basename($imagePath));
                Storage::put('public/' . $imagePath, file_get_contents($image));

                DB::table('item_images')->insert($itemImage);
            }
        }
    }
}
