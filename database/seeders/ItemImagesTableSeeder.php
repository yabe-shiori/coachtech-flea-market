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
        $imagePaths = [
            1 => ['/images/dummy1.jpeg', '/images/dummy2.jpeg', '/images/dummy3.jpeg'],
            2 => ['/images/dummy2.jpeg', '/images/dummy3.jpeg', '/images/dummy4.jpeg'],
            3 => ['/images/dummy3.jpeg', '/images/dummy4.jpeg', '/images/dummy5.jpeg'],
            4 => ['/images/dummy4.jpeg', '/images/dummy5.jpeg', '/images/dummy6.jpeg'],
            5 => ['/images/dummy5.jpeg', '/images/dummy6.jpeg', '/images/dummy7.jpeg'],
            6 => ['/images/dummy6.jpeg', '/images/dummy7.jpeg', '/images/dummy8.jpeg'],
            7 => ['/images/dummy7.jpeg', '/images/dummy8.jpeg', '/images/dummy9.jpeg'],
            8 => ['/images/dummy8.jpeg', '/images/dummy9.jpeg', '/images/dummy10.jpeg'],
            9 => ['/images/dummy9.jpeg', '/images/dummy10.jpeg', '/images/dummy11.jpeg'],
            10 => ['/images/dummy10.jpeg', '/images/dummy11.jpeg', '/images/dummy12.jpeg'],
            11 => ['/images/dummy11.jpeg', '/images/dummy12.jpeg', '/images/dummy13.jpeg'],
            12 => ['/images/dummy12.jpeg', '/images/dummy13.jpeg', '/images/dummy14.jpeg'],
            13 => ['/images/dummy13.jpeg', '/images/dummy14.jpeg', '/images/dummy15.jpeg'],
            14 => ['/images/dummy14.jpeg', '/images/dummy15.jpeg', '/images/dummy1.jpeg'],
            15 => ['/images/dummy15.jpeg', '/images/dummy16.jpeg', '/images/dummy17.jpeg'],
            16 => ['/images/dummy16.jpeg', '/images/dummy17.jpeg', '/images/dummy18.jpeg'],
            17 => ['/images/dummy17.jpeg', '/images/dummy18.jpeg', '/images/dummy19.jpeg'],
            18 => ['/images/dummy18.jpeg', '/images/dummy19.jpeg', '/images/dummy20.jpeg'],
            19 => ['/images/dummy19.jpeg', '/images/dummy20.jpeg', '/images/dummy21.jpeg'],
            20 => ['/images/dummy20.jpeg', '/images/dummy21.jpeg', '/images/dummy1.jpeg'],
        ];

        foreach ($imagePaths as $itemId => $paths) {
            foreach ($paths as $path) {
                $itemImage = [
                    'item_id' => $itemId,
                    'image_path' => $path,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                $image = public_path('images/' . basename($path));
                Storage::put('public' . $path, file_get_contents($image));

                DB::table('item_images')->insert($itemImage);
            }
        }
    }
}
