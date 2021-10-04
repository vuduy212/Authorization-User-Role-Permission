<?php

namespace Tests\Feature\Role;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class DeleteRoleTest extends TestCase
{

    /** @test*/
    public function not_admin_cant_see_delete_role_button()
    {
        $this->loginWithClientRole();

        $response = $this->get($this->getRoleIndexRoute());
        $response->assertStatus(200);
        $response->assertDontSeeText('DELETE');
    }

    /** @test*/
    public function admin_can_see_delete_role_button()
    {
        $this->loginWithAdminRole();

        $response = $this->get($this->getRoleIndexRoute());
        $response->assertStatus(200);
        $response->assertSeeText('DELETE');
    }

    /** @test */
    public function admin_can_delete_role()
    {
        $this->loginWithAdminRole();
        $role = Role::factory()->create();
        $response = $this->delete($this->getRoleDeleteRoute($role));
        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseMissing('roles', $role->toArray());
    }

    /** @test */
    public function not_admin_cant_delete_role()
    {
        $this->loginWithAdminRole();
        $role = Role::factory()->create();
        $response = $this->delete($this->getRoleDeleteRoute($role));
        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseMissing('roles', $role->toArray());
    }
}
