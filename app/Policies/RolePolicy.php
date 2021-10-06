<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;


    public function view(User $user)
    {
        return $user->hasPermission(['role.view']);
    }

    public function create(User $user)
    {
        return $user->hasPermission(['role.create']);
    }

    public function update(User $user)
    {
        return $user->hasPermission(['role.update']);
    }

    public function delete(User $user)
    {
        return $user->hasPermission(['role.delete']);
    }

}
