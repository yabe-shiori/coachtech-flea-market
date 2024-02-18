<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use Carbon\Carbon;
use App\Models\Category;

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
                'name' => 'ヴィンテージデニムジャケット',
                'category_ids' => [6, 10],
                'brand_id' => 1,
                'price' => 8500,
                'condition' => '目立った傷や汚れなし',
                'description' => 'クラシックなスタイルのヴィンテージデニムジャケットです。ユーズド感があり、オシャレな一着です。',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'user_id' => 1,
                'name' => 'レトロスタイルカメラ',
                'category_ids' => [37, 38],
                'brand_id' => 2,
                'price' => 12000,
                'condition' => '傷や汚れあり',
                'description' => 'レトロなデザインのフィルムカメラです。クラシックな写真を楽しみたい方におすすめです。',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'user_id' => 1,
                'name' => ' ミニチュアフィギュアコレクション',
                'category_ids' => [37, 38],
                'brand_id' => 3,
                'price' => 2000,
                'condition' => '目立った傷や汚れなし',
                'description' => '人気キャラクターのミニチュアフィギュアのコレクションセットです。ディスプレイやプレゼントに最適です。',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'user_id' => 1,
                'name' => '折りたたみ式キャンプチェア',
                'category_ids' => [24, 46],
                'brand_id' => 4,
                'price' => 6500,
                'condition' => '新品、未使用',
                'description' => 'コンパクトに折りたためるキャンプチェアです。キャンプや釣りなどのアウトドア活動に便利です。',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'user_id' => 1,
                'name' => 'プラントスタンド',
                'category_ids' => [19, 27],
                'brand_id' => 5,
                'price' => 2800,
                'condition' => '目立った傷や汚れなし',
                'description' => '植物を飾るためのスタイリッシュなプラントスタンドです。お部屋のアクセントになります。',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'user_id' => 1,
                'name' => 'ドライヤー＆ストレートアイロンセット',
                'category_ids' => [48],
                'brand_id' => 6,
                'price' => 9200,
                'condition' => '全体的に状態が悪い',
                'description' => 'ヘアスタイリングに便利なドライヤーとストレートアイロンのセットです。髪を健康的にスタイリングできます。',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'user_id' => 1,
                'name' => 'ワイヤレスイヤホン',
                'category_ids' => [11, 18],
                'brand_id' => 7,
                'price' => 4500,
                'condition' => '新品、未使用',
                'description' => 'Bluetooth対応のワイヤレスイヤホンです。ワイヤに邪魔されずに音楽を楽しめます。',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'user_id' => 1,
                'name' => ' カラフルなキッチンツールセット',
                'category_ids' => [19, 20],
                'brand_id' => 8,
                'price' => 3800,
                'condition' => '未使用に近い',
                'description' => 'カラフルで使いやすいキッチンツールのセットです。料理が楽しくなるアイテムです。',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'user_id' => 1,
                'name' => 'サーフボード',
                'category_ids' => [44, 46],
                'brand_id' => 9,
                'price' => 25000,
                'condition' => '目立った傷や汚れなし',
                'description' => 'サーフィン用の高品質なサーフボードです。波乗りを楽しむための必須アイテムです。',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'user_id' => 1,
                'name' => 'ベビーカー',
                'category_ids' => [52, 26],
                'brand_id' => 10,
                'price' => 12800,
                'condition' => 'やや傷や汚れあり',
                'description' => '赤ちゃんを快適に乗せることができるベビーカーです。安全性と快適性を追求したデザインです。',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'user_id' => 1,
                'name' => 'ダウンジャケット',
                'category_ids' => [6, 10],
                'brand_id' => 10,
                'price' => 7500,
                'condition' => '目立った傷や汚れなし',
                'description' => '冬の寒さから身を守る暖かいダウンジャケットです。軽量で動きやすく、機能性も兼ね備えています。',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'user_id' => 1,
                'name' => 'スマートウォッチ',
                'category_ids' => [11, 18],
                'brand_id' => 10,
                'price' => 14000,
                'condition' => '新品、未使用',
                'description' => '心拍数や運動データを計測できるスマートウォッチです。健康管理やフィットネスに役立ちます。',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'user_id' => 1,
                'name' => 'マジカルスターライトプロジェクター',
                'category_ids' => [19, 24],
                'brand_id' => 10,
                'price' => 4800,
                'condition' => '新品、未使用',
                'description' => ' 星空のような美しい光景を部屋に演出するマジカルスターライトプロジェクターです。リラックス効果があり、子供部屋や寝室での使用におすすめです。光の色や明るさも調節可能です。',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'user_id' => 1,
                'name' => 'フローラルドレス',
                'category_ids' => [1, 4],
                'brand_id' => 10,
                'price' => 3200,
                'condition' => '目立った傷や汚れなし',
                'description' => '華やかな花柄が特徴のエレガントなドレスです。サイズはSサイズで、カラーはパステルピンクです。パーティーや特別なイベントにぴったりの一着です。',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'user_id' => 1,
                'name' => ' キッズシューズ',
                'category_ids' => [52, 53],
                'brand_id' => 10,
                'price' => 2500,
                'condition' => '新品、未使用',
                'description' => '可愛らしいデザインのキッズシューズです。サイズは15cmで、カラーはピンクです。履きやすくて丈夫なので、お子様にぴったりです。',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($items as $item) {
            // 商品をitemsテーブルに挿入
            $itemId = DB::table('items')->insertGetId([
                'user_id' => $item['user_id'],
                'name' => $item['name'],
                'brand_id' => $item['brand_id'],
                'price' => $item['price'],
                'condition' => $item['condition'],
                'description' => $item['description'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // 商品に関連するカテゴリーをitem_categoriesテーブルに挿入
            foreach ($item['category_ids'] as $categoryId) {
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

