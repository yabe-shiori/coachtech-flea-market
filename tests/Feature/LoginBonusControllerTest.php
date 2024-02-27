<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\LoginBonusHistory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginBonusControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function testDrawMethodWithAlreadyReceivedBonus()
    {
        $user = User::factory()->create();

        LoginBonusHistory::create([
            'user_id' => $user->id,
            'points_awarded' => 5,
            'date_awarded' => now(),
        ]);

        $response = $this->actingAs($user)->postJson(route('user.draw'));

        $response->assertJson([
            'success' => false,
            'message' => '本日のログインボーナスは既に受け取っています。',
        ]);
    }

    public function testDrawMethodWithNoReceivedBonus()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson(route('user.draw'));

        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('points', [
            'user_id' => $user->id,
            'balance' => 10,
        ]);

        $this->assertDatabaseHas('login_bonus_histories', [
            'user_id' => $user->id,
            'points_awarded' => 10,
        ]);
    }
}
