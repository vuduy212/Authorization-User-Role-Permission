<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;

class RoleService
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function search(Request $request)
    {
        return $this->roleRepository->search($request->all());
    }

    public function createRole(Request $request)
    {
        return $this->roleRepository->createRole($request->all());
    }

    public function updateRole(Request $request, Role $role)
    {
        return $this->roleRepository->updateRole($request, $role);
    }

    public function deleteRole(Role $role)
    {
        return $this->roleRepository->deleteRole($role);
    }
}
