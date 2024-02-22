<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProfilesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('profiles')->insert([
            [
                'user_id' => 1,
                'display_name' => 'トレンドウォッチャー',
                'introduction' => 'プロフィールをご覧いただきありがとうございます。
                トレンドを見つけるのが得意です。
                気持ちの良い対応を心がけてまいりますので、よろしくお願いします！',
                'postal_code' => '1234567',
                'address' => '北海道札幌市中央区北1条西2丁目',
                'building_name' => '札幌パークビル',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 2,
                'display_name' => 'キラキラショッパー',
                'introduction' => '＊購入につていて
                ・即購入大歓迎です。交渉中であっても先に購入された方を優先させていただきます。
                ・商品購入の際、気になる点はご質問ください。必ず返信いたします。',
                'postal_code' => '2345678',
                'address' => '北海道帯広市西4条南9丁目',
                'building_name' => '帯広ヒルズ',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 3,
                'display_name' => 'わんころマーケッター',
                'introduction' => 'プロフィールをお読みいただきありがとうございます。
                仕事の都合上、お返事ができなかったり、遅くなる場合がございます。ご了承ください。
                気持ちの良いお取引をしたいと考えております。よろしくお願いたします。',
                'postal_code' => '3456789',
                'address' => '北海道岩内郡岩内町字本町',
                'building_name' => '岩内ハイツ',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
