<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleRepository extends BaseRepository
{

    public function model()
    {
        return Role::class;
    }

    public function getPermissionsID($permissions)
    {
        $getPermissions = [];
        foreach ($permissions as $permission) {
            $getPermissions[] = $permission;
        }
        return $getPermissions;
    }

    public function search(array $data)
    {
        $roleName = array_key_exists('key', $data) ? $data['key'] : null;
        return $this->model->searchRoleName($roleName)->latest('id')->paginate(array_key_exists('number', $data) ? $data['number'] : 5);
    }

    public function scopeSearchRoleName($query, $roleName)
    {
        return $query->where('name', 'like', '%' . $roleName . '%');
    }

    public function createRole(array $data)
    {
        $role = $this->model->create([
            'name' => $data['name'],
        ]);
        if (empty($data['permissions'])) {
            $permissions = [
                'List user' => '5'
            ];
        } else {
            $permissions = $this->getPermissionsID($data['permissions']);
        }
        $role->attachPermissions($permissions);
        return $role;
    }

    public function updateRole(Request $request, Role $role)
    {
        $role->permissions()->sync($request->permissions);
        $role->name = $request->name;
        $role->save();
        return $role;
    }

    public function deleteRole(Role $role)
    {
        $role->permissions()->detach();
        $role->delete();
    }
}
