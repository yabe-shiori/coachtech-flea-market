<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use App\Models\ItemImage;

class StripeControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function testCreateSession()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $item = Item::factory()->create();

        $response = $this->postJson(route('user.checkout', ['itemId' => $item->id]), [
            'payment_method' => 'card',
            'points_to_use' => 0,
        ]);

        $response->assertOk();

        $response->assertJsonStructure(['id']);
    }

    public function testSuccess()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();
        $this->actingAs($user);

        $sessionId = 'stripe_session_id';
        Session::put('stripe_checkout_session_id', $sessionId);

        $response = $this->get(route('user.success', ['item_id' => $item->id]));

        $response->assertStatus(200);

        $this->assertDatabaseHas('sold_items', [
            'item_id' => $item->id,
            'buyer_id' => $user->id,
            'seller_id' => $item->user_id,
        ]);
    }

    public function testCancel()
    {
        $item = Item::factory()->create();
        $itemImage = ItemImage::factory()->create(['item_id' => $item->id]);

        $user = User::factory()->create();

        $user->points()->create(['balance' => 100]);

        $selectedPoints = 50;

        Session::put('selected_points', $selectedPoints);

        $this->actingAs($user);
        $response = $this->get(route('user.cancel', ['itemId' => $item->id]));

        $response->assertStatus(200);
        $response->assertViewIs('payment.checkout');
        $response->assertViewHas('item', $item);

        $userPointsAfterCancel = $user->points()->first()->balance;
        $this->assertEquals(150, $userPointsAfterCancel);
    }
}
