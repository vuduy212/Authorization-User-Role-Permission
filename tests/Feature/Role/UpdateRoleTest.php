<?php

namespace Tests\Feature\Role;

use Tests\TestCase;
use App\Models\Role;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class UpdateRoleTest extends TestCase
{

    /** @test*/
    public function not_admin_cant_see_edit_role_button()
    {
        $this->loginWithClientRole();
        $response = $this->get($this->getRoleIndexRoute());
        $response->assertStatus(200);
        $response->assertDontSeeText('EDIT');
    }

    /** @test*/
    public function admin_can_see_edit_role_button()
    {
        $this->loginWithAdminRole();
        $response = $this->get($this->getRoleIndexRoute());
        $response->assertStatus(200);
        $response->assertSeeText('EDIT');
    }

    /** @test */
    public function admin_can_see_form_edit_role()
    {
        $this->loginWithAdminRole();
        $role = Role::factory()->create();
        $response = $this->get($this->getRoleEditRoute($role));
        $response->assertViewIs('admin.roles.edit', $role);
        $response->assertSee($role->name);
        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function not_admin_cant_see_form_edit_role()
    {
        $this->loginWithClientRole();
        $role = Role::factory()->create();
        $response = $this->get($this->getRoleEditRoute($role));
        $response->assertRedirect(route('denies'));
        $response->assertStatus(Response::HTTP_FOUND);
    }

    /** @test*/
    public function not_admin_cant_update_role()
    {
        $this->loginWithClientRole();
        $role = Role::factory()->create();
        $response = $this->put($this->getRoleUpdateRoute($role), $role->toArray());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('denies'));
    }

    /** @test */
    public function admin_can_update_role()
    {
        $this->loginWithAdminRole();
        $role = Role::factory()->create();
        $name = Str::random(5) . ' update';
        $role->name = $name;
        $role->password_confirmation = $this->getPassword();
        $response = $this->put($this->getRoleUpdateRoute($role), $role->toArray());
        $this->assertDatabaseHas('roles', ['id' => $role->id, 'name' => $name]);
    }
}
