<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\PermissionPolicy;
use App\Policies\UserPolicy;
use App\Policies\RolePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->rolePolicies();
        $this->userPolicies();
        $this->permissionPolicies();

        // Gate::define('manage-users', function($user)
        // {
        //     return $user->hasAnyRoles(['admin', 'author']);
        // });

        // Gate::define('edit-users', function($user)
        // {
        //     //return $user->hasRole('admin');
        //     return $user->hasAnyRoles(['admin', 'author']);
        // });

        // Gate::define('delete-users', function($user)
        // {
        //     return $user->hasRole('admin');
        // });
    }

    public function userPolicies()
    {
        Gate::define("user.view", [UserPolicy::class, "view"]);
        Gate::define("user.create", [UserPolicy::class, "create"]);
        Gate::define("user.update", [UserPolicy::class, "update"]);
        Gate::define("user.delete", [UserPolicy::class, "delete"]);
    }

    public function rolePolicies()
    {
        Gate::define("role.view", [RolePolicy::class, "view"]);
        Gate::define("role.create", [RolePolicy::class, "create"]);
        Gate::define("role.update", [RolePolicy::class, "update"]);
        Gate::define("role.delete", [RolePolicy::class, "delete"]);
    }

    public function permissionPolicies()
    {
        Gate::define("permission.view", [PermissionPolicy::class, "view"]);
        Gate::define("permission.create", [PermissionPolicy::class, "create"]);
        Gate::define("permission.update", [PermissionPolicy::class, "update"]);
        Gate::define("permission.delete", [PermissionPolicy::class, "delete"]);
    }
}
