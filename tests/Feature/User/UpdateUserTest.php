<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class UpdateUserTest extends TestCase
{

    /** @test*/
    public function not_admin_cant_see_edit_user_button()
    {
        $this->loginWithClientRole();
        $response = $this->get($this->getUserIndexRoute());
        $response->assertStatus(200);
        $response->assertDontSeeText('EDIT');
    }

    /** @test*/
    public function admin_can_see_edit_user_button()
    {
        $this->loginWithAdminRole();
        $response = $this->get($this->getUserIndexRoute());
        $response->assertStatus(200);
        $response->assertSeeText('EDIT');
    }

    /** @test */
    public function admin_can_see_form_edit_user()
    {
        $this->loginWithAdminRole();

        $user = User::factory()->create();
        $response = $this->get($this->getUserEditRoute($user));
        $response->assertViewIs('admin.users.edit', $user);
        $response->assertSee($user->name);
        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function not_admin_cant_see_form_edit_user()
    {
        $this->loginWithClientRole();

        $user = User::factory()->create();
        $response = $this->get($this->getUserEditRoute($user));
        $response->assertRedirect(route('denies'));
        $response->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function admin_can_update_user()
    {
        $this->loginWithAdminRole();
        $user = User::factory()->create()->makeVisible('password');

        $name = Str::random(5) . ' update';
        $email = Str::random(5) . '@update';

        $user->name = $name;
        $user->email = $email;

        $user->password_confirmation = $this->getPassword();
        $response = $this->put($this->getUserUpdateRoute($user), $user->toArray());
        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => $name, 'email' => $email]);
    }

    /** @test */
    public function not_admin_cant_update_user()
    {
        $this->loginWithClientRole();
        $user = User::factory()->create()->makeVisible('password');
        $name = Str::random(5) . ' update';
        $user->name = $name;
        $user->password_confirmation = $this->getPassword();
        $response = $this->put($this->getUserUpdateRoute($user), $user->toArray());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('denies'));
    }

    /** @test */
    public function admin_cant_update_user_if_name_field_is_null()
    {
        $this->loginWithAdminRole();
        $user = User::factory()->create()->makeVisible('password');
        $user->name = null;
        $user->password_confirmation = $this->getPassword();

        $response = $this->from($this->getUserEditRoute($user))->put($this->getUserUpdateRoute($user), $user->toArray());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function admin_cant_update_user_if_email_existed()
    {
        $this->loginWithAdminRole();
        $email = $this->getExistedEmail();
        $user = User::factory()->create()->makeVisible('password');
        $user->email = $email;
        $user->password_confirmation = $this->getPassword();

        $response = $this->from($this->getUserEditRoute($user))->put($this->getUserUpdateRoute($user), $user->toArray());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors('email');
    }
}
