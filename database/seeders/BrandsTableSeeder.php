<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            'Nike',
            'Adidas',
            'Uniqlo',
            'GU',
            'Louis Vuitton',
            'Gucci',
            'Prada',
            'Chanel',
            'Supreme',
            'Off-White'
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->insert([
                'name' => $brand,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
