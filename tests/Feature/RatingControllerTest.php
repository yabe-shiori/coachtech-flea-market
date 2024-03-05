<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Item;
use App\Models\User;
use App\Models\Rating;

class RatingControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    public function testRatingCreationForm()
    {
        $user = User::factory()->create();

        $item = Item::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('user.rating.create', ['item_id' => $item->id]));

        $response->assertStatus(200);

        $response->assertSee($item->seller_id);
    }

    public function testRatingCreation()
    {
        $user = User::factory()->create();

        $item = Item::factory()->create();

        $ratingData = [
            'rating' => 5,
            'comment' => 'Great seller!',
            'item_id' => $item->id,
        ];

        $response = $this->actingAs($user)
            ->post(route('user.rating.store'), $ratingData);

        $this->assertDatabaseHas('ratings', [
            'rating' => $ratingData['rating'],
            'comment' => $ratingData['comment'],
            'from_user_id' => $user->id,
            'to_user_id' => $item->user_id,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('message', '評価を登録しました');
    }

    public function testRatingIndex()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $ratings = Rating::where('to_user_id', $user->id)->latest()->paginate(10);

        $response = $this->actingAs($user)->get(route('user.rating.index', ['userId' => $user->id]));

        $response->assertStatus(200);
        $response->assertViewIs('rating.index');
        $response->assertViewHas('user', $user);
    }
}
