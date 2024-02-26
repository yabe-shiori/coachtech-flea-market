<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Comment;
use App\Models\ItemImage;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testShow()
    {
        $user = User::factory()->create();

        $item = Item::factory()->create();

        ItemImage::factory()->create([
            'item_id' => $item->id,
            'image_path' => 'test_image.jpg',
        ]);

        $comment = Comment::factory()->create([
            'item_id' => $item->id,
            'sender_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->get(route('user.comment.show', ['item' => $item->id]));

        $response->assertOk();

        $response->assertSeeText($comment->body);
    }
    public function testCommentStore()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create(['is_sold' => false]);
        $commentData = [
            'body' => 'テストコメント',
            'item_id' => $item->id,
        ];

        $this->actingAs($user);
        $response = $this->post(route('user.comment.store', ['item' => $item->id]), $commentData);
        $response->assertRedirect();
        $this->assertDatabaseHas('comments', [
            'body' => $commentData['body'],
            'item_id' => $item->id,
            'sender_id' => $user->id,
            'receiver_id' => $item->user_id,
        ]);
    }

    public function testCommentStoreForSoldItem()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create(['is_sold' => true]);
        $commentData = [
            'body' => 'テストコメント',
            'item_id' => $item->id,
        ];

        $this->actingAs($user);
        $response = $this->post(route('user.comment.store', ['item' => $item->id]), $commentData);
        $response->assertRedirect();
        $response->assertSessionHas('error', 'こちらの商品は売り切れなのでコメントできません。');
        $this->assertDatabaseMissing('comments', [
            'body' => $commentData['body'],
            'item_id' => $item->id,
            'sender_id' => $user->id,
            'receiver_id' => $item->user_id,
        ]);
    }

    public function testCommentDestroy()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create(['user_id' => $user->id]);
        $comment = Comment::factory()->create([
            'sender_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $this->actingAs($user);
        $response = $this->delete(route('user.comment.destroy', ['item' => $item->id, 'comment' => $comment->id]));
        $response->assertRedirect();
        $response->assertSessionHas('message', 'コメントを削除しました');
        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id,
        ]);
    }

    public function testCommentDestroyUnauthorized()
    {

        $user = User::factory()->create();
        $item = Item::factory()->create();
        $comment = Comment::factory()->create(['item_id' => $item->id]);
        $anotherUser = User::factory()->create();

        $this->actingAs($anotherUser);
        $response = $this->delete(route('user.comment.destroy', ['item' => $item->id, 'comment' => $comment->id]));

        $response->assertRedirect();
        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
        ]);
    }

    public function testCommentDestroyAuthorized()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create(['user_id' => $user->id]);
        $comment = Comment::factory()->create([
            'item_id' => $item->id,
            'sender_id' => $user->id,
        ]);

        $this->actingAs($user);
        $response = $this->delete(route('user.comment.destroy', ['item' => $item->id, 'comment' => $comment->id]));

        $response->assertRedirect();
        $response->assertSessionHas('message', 'コメントを削除しました');
        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id,
        ]);
    }
}
