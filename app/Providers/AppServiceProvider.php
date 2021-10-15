<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

       $this->customIfStatementSuperAdmin();
       $this->customViewUser();
       $this->customViewRole();
       $this->customViewPermission();
       $this->customCreateUser();
       $this->customCreateRole();
       $this->customCreatePermission();
       $this->customUpdateUser();
       $this->customUpdateRole();
       $this->customUpdatePermission();
       $this->customDeleteUser();
       $this->customDeleteRole();
       $this->customDeletePermission();
    }

    public function customIfStatementSuperAdmin()
    {
        Blade::if('super', function () {
            return auth()->user()->hasRole(['Super Admin']);
        });
    }

    public function hasPermission()
    {
        Blade::if('hasPermission', function ($permission)
        {
            return auth()->user()->hasPermission([
                $permission,
            ]);
        });
    }

    public function customViewUser()
    {
        Blade::if('viewuser', function () {
            return auth()->user()->hasPermission([
                'user.view',
            ]);
        });
    }

    public function customViewRole()
    {
        Blade::if('viewrole', function () {
            return auth()->user()->hasPermission([
                'role.view',
            ]);
        });
    }

    public function customViewPermission()
    {
        Blade::if('viewpermission', function () {
            return auth()->user()->hasPermission([
                'permission.view',
            ]);
        });
    }

    public function customUpdateUser()
    {
        Blade::if('updateuser', function () {
            return auth()->user()->hasPermission([
                'user.update',
            ]);
        });
    }

    public function customUpdateRole()
    {
        Blade::if('updaterole', function () {
            return auth()->user()->hasPermission([
                'role.update',
            ]);
        });
    }

    public function customUpdatePermission()
    {
        Blade::if('updatepermission', function () {
            return auth()->user()->hasPermission([
                'permission.update',
            ]);
        });
    }

    public function customCreateUser()
    {
        Blade::if('createuser', function () {
            return auth()->user()->hasPermission([
                'user.create',
            ]);
        });
    }

    public function customCreateRole()
    {
        Blade::if('createrole', function () {
            return auth()->user()->hasPermission([
                'role.create',
            ]);
        });
    }

    public function customCreatePermission()
    {
        Blade::if('createpermission', function () {
            return auth()->user()->hasPermission([
                'permission.create',
            ]);
        });
    }

    public function customDeleteUser()
    {
        Blade::if('deleteuser', function () {
            return auth()->user()->hasPermission([
                'user.delete',
            ]);
        });
    }

    public function customDeleteRole()
    {
        Blade::if('deleterole', function () {
            return auth()->user()->hasPermission([
                'role.delete',
            ]);
        });
    }

    public function customDeletePermission()
    {
        Blade::if('deletepermission', function () {
            return auth()->user()->hasPermission([
                'permission.delete',
            ]);
        });
    }
}
