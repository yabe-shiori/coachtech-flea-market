<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class GoogleLoginControllerTest extends TestCase
{
    use RefreshDatabase;
    public function testRedirectToGoogle()
    {
        $response = $this->get(route('user.login.google'));
        $response->assertStatus(302);
        $response->assertRedirect();
    }

    public function testGoogleCallback()
    {
        $googleUserMock = Mockery::mock('Laravel\Socialite\Two\User');
        $googleUserMock->shouldReceive('getEmail')
            ->andReturn('test@example.com');

        $socialiteMock = Mockery::mock('Laravel\Socialite\Contracts\Factory');
        $socialiteMock->shouldReceive('driver->user')
            ->andReturn($googleUserMock);


        $this->app->instance('Laravel\Socialite\Contracts\Factory', $socialiteMock);

        $response = $this->get(route('user.login.google.callback'));

        $response->assertStatus(302);
        $response->assertRedirect(route('user.login'));
    }
}
