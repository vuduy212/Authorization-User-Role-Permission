<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->hasPermission(['permission.view']);
    }

    public function create(User $user)
    {
        return $user->hasPermission(['permission.create']);
    }

    public function update(User $user)
    {
        return $user->hasPermission(['permission.create']);
    }

    public function delete(User $user)
    {
        return $user->hasPermission(['permission.create']);
    }
}
