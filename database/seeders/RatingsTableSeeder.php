<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Rating;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rating::create([
            'from_user_id' => 1,
            'to_user_id' => 2,
            'rating' => 5,
            'comment' => '商品もきれいで対応もとてもよかったです。ありがとうございます！',
        ]);

        Rating::create([
            'from_user_id' => 1,
            'to_user_id' => 3,
            'rating' => 4,
            'comment' => '迅速な対応ありがとうございました。',
        ]);

        Rating::create([
            'from_user_id' => 2,
            'to_user_id' => 1,
            'rating' => 2,
            'comment' => '商品の状態が思ったより悪くて残念でした。',
        ]);

        Rating::create([
            'from_user_id' => 2,
            'to_user_id' => 3,
            'rating' => 3,
            'comment' => '商品届きました。この度はありがとうございました。',
        ]);

        Rating::create([
            'from_user_id' => 3,
            'to_user_id' => 1,
            'rating' => 2,
            'comment' => '新品、未使用とのことでしたが、使用感がありました。',
        ]);

        Rating::create([
            'from_user_id' => 3,
            'to_user_id' => 2,
            'rating' => 4,
            'comment' => '本日商品が届きました。良いお取引きができました。ありがとうございました。',
        ]);

    }
}
