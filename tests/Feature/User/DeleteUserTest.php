<?php

namespace Tests\Feature\User;

use App\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Response;

class DeleteUserTest extends TestCase
{

    /** @test*/
    public function not_admin_cant_see_delete_user_button()
    {
        $this->loginWithClientRole();
        $response = $this->get($this->getUserIndexRoute());
        $response->assertStatus(200);
        $response->assertDontSeeText('DELETE');
    }

    /** @test*/
    public function user_is_admin_can_see_delete_user_button()
    {
        $this->loginWithAdminRole();
        $response = $this->get($this->getUserIndexRoute());
        $response->assertStatus(200);
        $response->assertSeeText('DELETE');
    }

    /** @test */
    public function admin_can_delete_user()
    {
        $this->loginWithAdminRole();
        $user = User::factory()->create();
        $response = $this->delete($this->getUserDeleteRoute($user));
        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseMissing('users', $user->toArray());
    }

    /** @test */
    public function not_admin_cant_delete_user()
    {
        $this->loginWithAdminRole();
        $user = User::factory()->create();
        $response = $this->delete($this->getUserDeleteRoute($user));
        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseMissing('users', $user->toArray());
    }
}
