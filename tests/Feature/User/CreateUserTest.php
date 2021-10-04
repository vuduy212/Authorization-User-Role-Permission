<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Response;

class CreateUserTest extends TestCase
{

    /** @test*/
    public function not_admin_cant_see_create_user_button()
    {
        $this->loginWithClientRole();

        $response = $this->get($this->getUserIndexRoute());
        $response->assertDontSeeText('Create New User');
    }

    /** @test*/
    public function admin_can_see_create_user_button()
    {
        $this->loginWithAdminRole();

        $response = $this->get($this->getUserIndexRoute());
        $response->assertSeeText('Create New User');
    }

    /** @test */
    public function admin_can_view_form_create_user()
    {
        $this->loginWithAdminRole();

        $response = $this->get($this->getUserCreateRoute());
        $response->assertViewIs('admin.users.create');
        $response->assertStatus(200);
    }

    /** @test */
    public function not_admin_cannot_view_form_create_user()
    {
        $this->loginWithClientRole();

        $response = $this->get($this->getUserCreateRoute());
        $response->assertRedirect(route('denies'));
        $response->assertStatus(302);
    }

    /** @test */
    public function admin_can_create_user()
    {
        $this->loginWithAdminRole();

        $user = User::factory()->make([
            'password_confirmation' => $this->getPassword()
        ])->makeVisible('password');

        $response = $this->post($this->getUserStoreRoute(), $user->toArray());
        $response->assertRedirect($this->getUserIndexRoute());
        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('users', ['email' => $user->email]);
    }

    /** @test */
    public function not_admin_cant_create_user()
    {
        $this->loginWithClientRole();
        $user = User::factory()->make([
            'password_confirmation' => $this->getPassword()
        ])->makeVisible('password');
        $response = $this->post($this->getUserStoreRoute(), $user->toArray());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('denies'));
    }

    /** @test */
    public function admin_cant_create_user_if_name_field_is_null()
    {
        $this->loginWithAdminRole();
        $user = User::factory()->make([
            'name' => null,
            'password_confirmation' => $this->getPassword()
        ])->makeVisible('password');
        $response = $this->from($this->getUserCreateRoute())->post($this->getUserStoreRoute(), $user->toArray());
        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function admin_cant_create_user_if_email_existed()
    {
        $this->loginWithAdminRole();
        $user = User::factory()->make([
            'email' => $this->getExistedEmail(),
            'password_confirmation' => $this->getPassword()
        ])->makeVisible('password');
        $response = $this->from($this->getUserCreateRoute())
            ->post($this->getUserStoreRoute(), $user->toArray());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors('email');
    }
}
