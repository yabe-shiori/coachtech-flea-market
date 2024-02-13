<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use Carbon\Carbon;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'user_id' => 1,
                'name' => 'テスト商品1',
                'category_id' => 1,
                'brand_id' => 1,
                'price' => 1000,
                'condition' => '新品、未使用',
                'description' => 'テスト商品1の説明です',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'user_id' => 1,
                'name' => 'テスト商品2',
                'category_id' => 2,
                'brand_id' => 2,
                'price' => 2000,
                'condition' => '未使用に近い',
                'description' => 'テスト商品2の説明です',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'user_id' => 1,
                'name' => 'テスト商品3',
                'category_id' => 3,
                'brand_id' => 3,
                'price' => 3000,
                'condition' => '目立った傷や汚れなし',
                'description' => 'テスト商品3の説明です',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'user_id' => 1,
                'name' => 'テスト商品4',
                'category_id' => 4,
                'brand_id' => 4,
                'price' => 4000,
                'condition' => 'やや傷や汚れあり',
                'description' => 'テスト商品4の説明です',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'user_id' => 1,
                'name' => 'テスト商品5',
                'category_id' => 5,
                'brand_id' => 5,
                'price' => 5000,
                'condition' => '傷や汚れあり',
                'description' => 'テスト商品5の説明です',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'user_id' => 1,
                'name' => 'テスト商品6',
                'category_id' => 6,
                'brand_id' => 6,
                'price' => 6000,
                'condition' => '全体的に状態が悪い',
                'description' => 'テスト商品6の説明です',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'user_id' => 1,
                'name' => 'テスト商品7',
                'category_id' => 7,
                'brand_id' => 7,
                'price' => 1000,
                'condition' => '新品、未使用',
                'description' => 'テスト商品7の説明です',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'user_id' => 1,
                'name' => 'テスト商品8',
                'category_id' => 8,
                'brand_id' => 8,
                'price' => 8000,
                'condition' => '未使用に近い',
                'description' => 'テスト商品8の説明です',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'user_id' => 1,
                'name' => 'テスト商品9',
                'category_id' => 9,
                'brand_id' => 9,
                'price' => 9000,
                'condition' => '目立った傷や汚れなし',
                'description' => 'テスト商品9の説明です',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'user_id' => 1,
                'name' => 'テスト商品10',
                'category_id' => 10,
                'brand_id' => 10,
                'price' => 10000,
                'condition' => 'やや傷や汚れあり',
                'description' => 'テスト商品10の説明です',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($items as $item) {
            $itemId = DB::table('items')->insertGetId([
                'user_id' => $item['user_id'],
                'name' => $item['name'],
                'brand_id' => $item['brand_id'],
                'category_id' => $item['category_id'],
                'price' => $item['price'],
                'condition' => $item['condition'],
                'description' => $item['description'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $categories = [1, 2, 3];
            foreach ($categories as $categoryId) {
                DB::table('item_categories')->insert([
                    'item_id' => $itemId,
                    'category_id' => $categoryId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

    }

}
