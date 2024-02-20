<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SoldItem;
use App\Models\Item;

class SoldItemsTableSeeder extends Seeder
{

    public function run(): void
    {
        SoldItem::create([
            'item_id' => 1,
            'buyer_id' => 2,
            'seller_id' => 1,
            'sold_at' => now(),
        ]);

        Item::where('id', 1)->update(['is_sold' => true]);

        SoldItem::create([
            'item_id' => 4,
            'buyer_id' => 3,
            'seller_id' => 1,
            'sold_at' => now(),
        ]);


        Item::where('id', 4)->update(['is_sold' => true]);

        SoldItem::create([
            'item_id' => 6,
            'buyer_id' => 2,
            'seller_id' => 3,
            'sold_at' => now(),
        ]);

        Item::where('id', 6)->update(['is_sold' => true]);
    }
}
