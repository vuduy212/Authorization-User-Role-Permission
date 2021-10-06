<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class ReadUserTest extends TestCase
{
    /** @test*/
    public function not_admin_cant_see_detail_user_button()
    {
        $this->loginWithClientRole();
        $response = $this->get($this->getUserIndexRoute());
        $response->assertStatus(200);
        $response->assertDontSeeText('DETAIL');
    }

    /** @test*/
    public function admin_can_see_detail_user_button()
    {
        $this->loginWithAdminRole();
        $response = $this->get($this->getUserIndexRoute());
        $response->assertStatus(200);
        $response->assertSeeText('DETAIL');
    }

    /** @test*/
    public function admin_can_see_detail_user()
    {
        $this->loginWithAdminRole();
        $user = User::factory()->create();
        $user->roles()->attach($this->getRandomRole());
        $response = $this->get($this->getUserDetailRoute($user));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee($user->role)
            ->assertSee($user->name);
    }

    /** @test*/
    public function not_admin_cant_see_detail_user()
    {
        $this->loginWithClientRole();
        $user = User::factory()->create();
        $user->roles()->attach($this->getRandomRole());
        $response = $this->get($this->getUserDetailRoute($user));
        $response->assertRedirect(route('denies'));
    }
}
