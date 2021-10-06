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
        $this->customIfStatementViewDetail();
        $this->customIfStatementUpdate();
        $this->customIfStatementCreate();
        $this->customIfStatementDelete();
    }

    public function customIfStatementSuperAdmin()
    {
        Blade::if('super', function () {
            return auth()->user()->hasRole(['Super Admin']);
        });
    }

    public function customIfStatementViewDetail()
    {
        Blade::if('view', function () {
            return auth()->user()->hasPermission([
                'user.view',
                'role.view',
                'permission.view',
            ]);
        });
    }

    public function customIfStatementUpdate()
    {
        Blade::if('update', function () {
            return auth()->user()->hasPermission([
                'user.update',
                'role.update',
                'permission.update',
            ]);
        });
    }

    public function customIfStatementCreate()
    {
        Blade::if('create', function () {
            return auth()->user()->hasPermission([
                'user.create',
                'role.create',
                'permission.create',
            ]);
        });
    }

    public function customIfStatementDelete()
    {
        Blade::if('delete', function () {
            return auth()->user()->hasPermission([
                'user.delete',
                'role.delete',
                'permission.delete',
            ]);
        });
    }
}
