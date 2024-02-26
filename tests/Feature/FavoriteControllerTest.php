<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Favorite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Item;

class FavoriteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $items = Item::factory()->count(3)->hasImages(1)->create();

        foreach ($items as $item) {
            $favorite = Favorite::factory()->create([
                'user_id' => $user->id,
                'item_id' => $item->id,
            ]);
        }

        $response = $this->get(route('user.mylist'));

        $response->assertStatus(200);
        $response->assertViewIs('item.mylist');
    }

    public function testFavoriteWhenAuthenticated()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $item = Item::factory()->create();

        $response = $this->post(route('user.favorite'), ['item_id' => $item->id]);

        $response->assertRedirect();

        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }

    public function testFavoriteWhenUnauthenticated()
    {

        $response = $this->post(route('user.favorite'), ['item_id' => 1]);

        $response->assertRedirect(route('user.login'));
    }


    public function testRemoveFavorite()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $favorite = Favorite::factory()->create(['user_id' => $user->id]);

        $response = $this->post(route('user.removeFavorite'), ['item_id' => $favorite->item_id]);

        $response->assertRedirect();
    }
}
