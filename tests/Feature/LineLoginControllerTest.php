<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class LineLoginControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function testLineLogin()
    {
        $response = $this->get(route('user.linelogin'));
        $response->assertStatus(302);
        $response->assertRedirect();
    }

    public function testCallback()
    {
        $profile = (object) [
            'userId' => 'line_user_id',
            'displayName' => 'Test User'
        ];

        $lineLoginControllerMock = Mockery::mock('App\Http\Controllers\LineLoginController')->makePartial();
        $lineLoginControllerMock->shouldReceive('getAccessToken')->andReturn('real_access_token');
        $lineLoginControllerMock->shouldReceive('getProfile')->andReturn($profile);

        $this->app->instance('App\Http\Controllers\LineLoginController', $lineLoginControllerMock);
        $response = $this->actingAs(User::factory()->create())
            ->call('GET', route('user.callback'));

        $this->assertDatabaseHas('users', [
            'line_id' => 'line_user_id',
            'name' => 'Test User'
        ]);

        $this->assertTrue(Auth::check());

        $response->assertStatus(302);
        $response->assertRedirect(route('user.item.index'));
    }
}
