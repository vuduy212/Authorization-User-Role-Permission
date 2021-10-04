<?php

namespace Tests\Feature\Permission;

use App\Models\Permission;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class ReadPermissionTest extends TestCase
{

    /** @test */
    public function not_admin_cant_see_permission_detail_button()
    {
        $this->loginWithClientRole();

        $response = $this->get($this->getPermissionIndexRoute());
        $response->assertStatus(200);
        $response->assertDontSeeText('DETAIL');
    }

    /** @test */
    public function admin_can_see_permission_detail_button()
    {
        $this->loginWithAdminRole();

        $response = $this->get($this->getPermissionIndexRoute());
        $response->assertStatus(200);
        $response->assertSeeText('DETAIL');
    }

    /** @test */
    public function admin_can_see_detail_permission()
    {
        $this->loginWithAdminRole();
        $permission = Permission::where('name', 'List user')->first();
        $response = $this->get($this->getPermissionDetailRoute($permission));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee($permission->name);
    }
}
