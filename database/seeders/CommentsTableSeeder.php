<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::create([
            'sender_id' => 1,
            'receiver_id' => 3,
            'item_id' => 3,
            'body' => '発送はいつ頃になりますか？',
            'read_at' => now(),
        ]);

        Comment::create([
            'sender_id' => 3,
            'receiver_id' => 1,
            'item_id' => 3,
            'body' => '即日発送いたします。',
            'read_at' => now(),
        ]);

        Comment::create([
            'sender_id' => 1,
            'receiver_id' => 2,
            'item_id' => 2,
            'body' => '一万円までお値下げ可能でしょうか?',
            'read_at' => now(),
        ]);

        Comment::create([
            'sender_id' => 2,
            'receiver_id' => 1,
            'item_id' => 2,
            'body' => '申し訳ございません。お値下げはできません。',
            'read_at' => now(),
        ]);
    }
}
