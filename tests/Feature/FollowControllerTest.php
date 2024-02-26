<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FollowControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function testFollowAuthenticated()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $followedUser = User::factory()->create();

        $response = $this->post(route('user.follow', ['user' => $followedUser->id]));

        $response->assertRedirect();

        $this->assertTrue($user->following()->where('followed_id', $followedUser->id)->exists());
    }

    public function testUnfollowAuthenticated()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $followedUser = User::factory()->create();

        Follow::create([
            'follower_id' => $user->id,
            'followed_id' => $followedUser->id,
        ]);

        $response = $this->delete(route('user.unfollow', ['userId' => $followedUser->id]));

        $response->assertRedirect();

        $this->assertFalse($user->following()->where('followed_id', $followedUser->id)->exists());
    }

    public function testFollowUnauthenticated()

    {
        $response = $this->post(route('user.follow', ['user' => 1]));

        $response->assertRedirect(route('user.login'));
    }

    public function testUnfollowUnauthenticated()

    {
        $response = $this->delete(route('user.unfollow', ['userId' => 1]));

        $response->assertRedirect(route('user.login'));
    }

    public function testFollowSameUserTwice()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $followedUser = User::factory()->create();

        $this->post(route('user.follow', ['user' => $followedUser->id]));

        $response = $this->post(route('user.follow', ['user' => $followedUser->id]));

        $response->assertRedirect();
    }

    public function testUnfollowNonFollowing()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $followedUser = User::factory()->create();

        $response = $this->delete(route('user.unfollow', ['userId' => $followedUser->id]));

        $response->assertRedirect();
    }

    public function testAccessFollowingPageUnauthenticated()
    {
        $response = $this->get(route('user.following'));

        $response->assertRedirect(route('user.login'));
    }
}
