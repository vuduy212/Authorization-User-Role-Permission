<?php

namespace Tests;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /** login */
    public function loginWithClientRole()
    {
        $user = User::factory()->create();
        $roleId = Role::where('name', 'client')->first()->id;
        $user->attachRoles($roleId);
        $this->actingAs($user);
    }

    public function loginWithAdminRole()
    {
        $user = User::factory()->create();
        $roleId = Role::where('name', 'admin')->first()->id;
        $user->attachRoles($roleId);
        $this->actingAs($user);
    }

    public function login()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    /** create */
    public function CreateUser()
    {
        $user = User::factory()->make([
            'password_confirmation' => $this->getPassword()
        ])->makeVisible('password');
        return $user;
    }

    /** get role */
    public function getAdminRole()
    {
        $role = Role::where('name', 'admin')->first();
        return $role->id;
    }

    public function getRandomRole()
    {
        $roles = Role::all();
        foreach ($roles as $role) {
            $data[] = $role->id;
        }
        $position = array_rand($data);
        return $data[$position];
    }

    /** get index route */
    public function getUserIndexRoute()
    {
        return route('users.index');
    }

    public function getRoleIndexRoute()
    {
        return route('roles.index');
    }

    public function getPermissionIndexRoute()
    {
        return route('permissions.index');
    }

    /** get detail route */
    public function getUserDetailRoute(User $id)
    {
        return route('users.show', ['user' => $id]);
    }

    public function getRoleDetailRoute(Role $id)
    {
        return route('roles.show', ['role' => $id]);
    }

    public function getPermissionDetailRoute(Permission $id)
    {
        return route('permissions.show', ['permission' => $id]);
    }

    /** get create & store route */
    public function getUserCreateRoute()
    {
        return route('users.create');
    }

    public function getUserStoreRoute()
    {
        return route('users.store');
    }

    public function getRoleCreateRoute()
    {
        return route('roles.create');
    }

    public function getRoleStoreRoute()
    {
        return route('roles.store');
    }

    public function getPermissionCreateRoute()
    {
        return route('permissions.create');
    }

    public function getPermissionStoreRoute()
    {
        return route('permissions.store');
    }

    /** get edit & update route */
    public function getUserUpdateRoute(User $id)
    {
        return route('users.update', ['user' => $id]);
    }

    public function getUserEditRoute(User $id)
    {
        return route('users.edit', ['user' => $id]);
    }

    public function getRoleUpdateRoute(Role $id)
    {
        return route('roles.update', ['role' => $id]);
    }

    public function getRoleEditRoute(Role $id)
    {
        return route('roles.edit', ['role' => $id]);
    }

    public function getPermissionUpdateRoute(Permission $id)
    {
        return route('permissions.update', ['permission' => $id]);
    }

    /** delete route */
    public function getUserDeleteRoute(User $id)
    {
        return route('users.destroy', ['user' => $id]);
    }

    public function getRoleDeleteRoute(Role $id)
    {
        return route('roles.destroy', ['role' => $id]);
    }

    public function getPermissionDeleteRoute(Permission $id)
    {
        return route('permissions.destroy', ['permission' => $id]);
    }

    /** get validate */
    public function getPassword()
    {
        return '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
    }

    public function getExistedEmail()
    {
        $arr = User::all();
        foreach ($arr as $user) {
            $data[] = $user->email;
        }
        $position = array_rand($data);
        return $data[$position];
    }
}
