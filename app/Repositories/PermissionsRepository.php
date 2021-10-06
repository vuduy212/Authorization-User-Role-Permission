<?php

namespace App\Repositories;

use App\Models\Permission;

class PermissionsRepository extends BaseRepository
{
    public function model()
    {
        return Permission::class;
    }

    public function roles()
    {
        return $this->model->belongsToMany('App\Models\Role', 'role_permissions', 'id_permission', 'id_role');
    }

    public function search(array $data)
    {
        $permissionName = array_key_exists('key', $data) ? $data['key'] : null;
        return $this->model->searchPermissionName($permissionName)->latest('id')->paginate(array_key_exists('number', $data) ? $data['number'] : 5);
    }
}
