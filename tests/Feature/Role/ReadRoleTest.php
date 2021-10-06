<?php

namespace Tests\Feature\Role;

use Tests\TestCase;
use App\Models\Role;
use Illuminate\Http\Response;

class ReadRoleTest extends TestCase
{

    /** @test*/
    public function not_admin_cant_see_detail_role_button()
    {
        $this->loginWithClientRole();
        $response = $this->get($this->getRoleIndexRoute());
        $response->assertDontSeeText('DETAIL');
    }

    /** @test*/
    public function admin_can_see_detail_role_button()
    {
        $this->loginWithAdminRole();
        $response = $this->get($this->getRoleIndexRoute());
        $response->assertSeeText('DETAIL');
    }

    /** @test*/
    public function admin_can_see_detail_role()
    {
        $this->loginWithAdminRole();
        $role = Role::factory()->create();
        $response = $this->get($this->getRoleDetailRoute($role));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee($role->name);
    }

    /** @test*/
    public function not_admin_cant_see_detail_role()
    {
        $this->loginWithClientRole();
        $role = Role::factory()->create();
        $response = $this->get($this->getRoleDetailRoute($role));
        $response->assertRedirect(route('denies'));
    }
}
