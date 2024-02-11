<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ファッションカテゴリ
        $womensFashion = Category::create(['name' => 'レディースファッション']);
        Category::create(['name' => 'トップス', 'parent_id' => $womensFashion->id]);
        Category::create(['name' => 'ボトムス', 'parent_id' => $womensFashion->id]);
        Category::create(['name' => 'ワンピース', 'parent_id' => $womensFashion->id]);
        Category::create(['name' => 'アウター', 'parent_id' => $womensFashion->id]);

        $mensFashion = Category::create(['name' => 'メンズファッション']);
        Category::create(['name' => 'シャツ', 'parent_id' => $mensFashion->id]);
        Category::create(['name' => 'ジーンズ', 'parent_id' => $mensFashion->id]);
        Category::create(['name' => 'スーツ', 'parent_id' => $mensFashion->id]);
        Category::create(['name' => 'ジャケット', 'parent_id' => $mensFashion->id]);

        //エレクトロニクスカテゴリ
        $smartphones = Category::create(['name' => 'スマートフォン & アクセサリー']);
        Category::create(['name' => 'スマートフォン', 'parent_id' => $smartphones->id]);
        Category::create(['name' => 'ケース & カバー', 'parent_id' => $smartphones->id]);
        Category::create(['name' => '充電器', 'parent_id' => $smartphones->id]);

        $computers = Category::create(['name' => 'コンピューター & オフィス']);
        Category::create(['name' => 'ノートPC', 'parent_id' => $computers->id]);
        Category::create(['name' => 'デスクトップPC', 'parent_id' => $computers->id]);
        Category::create(['name' => '周辺機器', 'parent_id' => $computers->id]);

        // ホーム & ガーデンカテゴリ
        $homeGarden = Category::create(['name' => 'ホーム & ガーデン']);
        $kitchen = Category::create(['name' => 'キッチン用品', 'parent_id' => $homeGarden->id]);
        Category::create(['name' => '調理器具', 'parent_id' => $kitchen->id]);
        Category::create(['name' => '食器', 'parent_id' => $kitchen->id]);
        Category::create(['name' => 'キッチンストレージ', 'parent_id' => $kitchen->id]);

        $furniture = Category::create(['name' => '家具', 'parent_id' => $homeGarden->id]);
        Category::create(['name' => 'ソファ', 'parent_id' => $furniture->id]);
        Category::create(['name' => 'ベッド', 'parent_id' => $furniture->id]);
        Category::create(['name' => '収納家具', 'parent_id' => $furniture->id]);

        // エンターテイメントカテゴリ
        $entertainment = Category::create(['name' => 'エンターテイメント']);
        $books = Category::create(['name' => '本 & 文学', 'parent_id' => $entertainment->id]);
        Category::create(['name' => '小説', 'parent_id' => $books->id]);
        Category::create(['name' => 'マンガ', 'parent_id' => $books->id]);
        Category::create(['name' => '雑誌', 'parent_id' => $books->id]);

        $musicMovies = Category::create(['name' => '音楽 & 映画', 'parent_id' => $entertainment->id]);
        Category::create(['name' => 'CD', 'parent_id' => $musicMovies->id]);
        Category::create(['name' => 'DVD', 'parent_id' => $musicMovies->id]);
        Category::create(['name' => 'レコード', 'parent_id' => $musicMovies->id]);

        // ホビー & おもちゃカテゴリ
        $hobbiesToys = Category::create(['name' => 'ホビー & おもちゃ']);
        $hobbies = Category::create(['name' => 'ホビー', 'parent_id' => $hobbiesToys->id]);
        Category::create(['name' => 'モデルキット', 'parent_id' => $hobbies->id]);
        Category::create(['name' => 'コレクターズアイテム', 'parent_id' => $hobbies->id]);

        $gamesPuzzles = Category::create(['name' => 'ゲーム & パズル', 'parent_id' => $hobbiesToys->id]);
        Category::create(['name' => 'ボードゲーム', 'parent_id' => $gamesPuzzles->id]);
        Category::create(['name' => 'ビデオゲーム', 'parent_id' => $gamesPuzzles->id]);

        // スポーツ & アウトドアカテゴリ
        $sportsOutdoors = Category::create(['name' => 'スポーツ & アウトドア']);
        Category::create(['name' => 'フィットネス機器', 'parent_id' => $sportsOutdoors->id]);
        Category::create(['name' => 'アウトドア用品', 'parent_id' => $sportsOutdoors->id]);
        Category::create(['name' => 'スポーツウェア', 'parent_id' => $sportsOutdoors->id]);

        // ビューティー & ヘルスカテゴリ
        $beautyHealth = Category::create(['name' => 'ビューティー & ヘルス']);
        Category::create(['name' => '化粧品', 'parent_id' => $beautyHealth->id]);
        Category::create(['name' => 'スキンケア', 'parent_id' => $beautyHealth->id]);
        Category::create(['name' => 'サプリメント', 'parent_id' => $beautyHealth->id]);

        // キッズ & ベイビーカテゴリ
        $kidsBaby = Category::create(['name' => 'キッズ & ベイビー']);
        Category::create(['name' => '子供服', 'parent_id' => $kidsBaby->id]);
        Category::create(['name' => 'おもちゃ', 'parent_id' => $kidsBaby->id]);
        Category::create(['name' => '子供用家具', 'parent_id' => $kidsBaby->id]);

        // 自動車 & バイクカテゴリ
        $automotive = Category::create(['name' => '自動車 & バイク']);
        Category::create(['name' => '自動車パーツ', 'parent_id' => $automotive->id]);
        Category::create(['name' => 'カーアクセサリー', 'parent_id' => $automotive->id]);
        Category::create(['name' => 'バイク用品', 'parent_id' => $automotive->id]);

        // アート & 手作りカテゴリ
        $artHandmade = Category::create(['name' => 'アート & 手作り']);
        Category::create(['name' => '絵画', 'parent_id' => $artHandmade->id]);
        Category::create(['name' => '彫刻', 'parent_id' => $artHandmade->id]);
        Category::create(['name' => 'ハンドクラフト', 'parent_id' => $artHandmade->id]);

    }
}
