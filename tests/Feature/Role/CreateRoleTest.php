<?php

namespace Tests\Feature\Role;

use Tests\TestCase;
use App\Models\Role;
use Illuminate\Http\Response;

class CreateRoleTest extends TestCase
{

    /** @test*/
    public function not_admin_cant_see_create_role_button()
    {
        $this->loginWithClientRole();
        $response = $this->get($this->getRoleIndexRoute());
        $response->assertDontSeeText('Create New Role');
    }

    /** @test*/
    public function admin_can_see_create_role_button()
    {
        $this->loginWithAdminRole();

        $response = $this->get($this->getRoleIndexRoute());
        $response->assertSeeText('Create New Role');
    }

    /** @test */
    public function admin_can_view_form_create_role()
    {
        $this->loginWithAdminRole();
        $response = $this->get($this->getRoleCreateRoute());
        $response->assertViewIs('admin.roles.create');
        $response->assertStatus(200);
    }

    /** @test */
    public function not_admin_cannot_view_form_create_role()
    {
        $this->loginWithClientRole();
        $response = $this->get($this->getRoleCreateRoute());
        $response->assertRedirect(route('denies'));
        $response->assertStatus(302);
    }

    /** @test*/
    public function admin_can_create_role()
    {
        $this->loginWithAdminRole();
        $role = Role::factory()->create();
        $response = $this->post($this->getRoleStoreRoute(), $role->toArray());
        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('roles', ['name' => $role->name]);
    }

    /** @test */
    public function not_admin_cant_create_role()
    {
        $this->loginWithClientRole();
        $role = Role::factory()->create();
        $response = $this->post($this->getRoleStoreRoute(), $role->toArray());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('denies'));
    }
}
