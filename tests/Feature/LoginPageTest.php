<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginPageTest extends TestCase
{
    /** @test */
    public function test_view_login()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_redirect_without_login()
    {
        $response = $this->get('/home');
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function test_login()
    {
        $this->login();
        $response = $response = $this->get('/home');
        $response->assertStatus(200);
    }
}
