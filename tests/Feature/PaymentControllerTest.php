<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testNotLoggedIn()
    {
        $itemId = 1;
        $response = $this->get(route('user.payment.create', ['item' => $itemId]));

        $response->assertRedirect()
            ->assertSessionHas('error', 'ログインしてください。');
    }

    public function testNonexistentItem()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $itemId = 999;
        $response = $this->get(route('user.payment.create', ['item' => $itemId]));

        $response->assertNotFound();
    }

    public function testSoldOutItem()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $item = Item::factory()->create(['is_sold' => true]);

        $response = $this->get(route('user.payment.create', ['item' => $item->id]));

        $response->assertRedirect()
            ->assertSessionHas('error', '申し訳ありませんが、この商品は売り切れです。');
    }
}
