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

        // Blade::if('u.view', function ($value) {
        //     return config('user.view') === $value;
        // });

        // Blade::if('u.create', function ($value) {
        //     return config('user.create') === $value;
        // });

        // Blade::if('u.update', function ($value) {
        //     return config('user.update') === $value;
        // });

        // Blade::if('u.delete', function ($value) {
        //     return config('user.delete') === $value;
        // });

        // Blade::if('r.view', function ($value) {
        //     return config('role.view') === $value;
        // });

        // Blade::if('r.create', function ($value) {
        //     return config('role.create') === $value;
        // });

        // Blade::if('r.update', function ($value) {
        //     return config('role.update') === $value;
        // });

        // Blade::if('r.delete', function ($value) {
        //     return config('role.delete') === $value;
        // });

        // Blade::if('p.view', function ($value) {
        //     return config('permission.view') === $value;
        // });

        // Blade::if('p.create', function ($value) {
        //     return config('permission.create') === $value;
        // });

        // Blade::if('p.update', function ($value) {
        //     return config('permission.update') === $value;
        // });

        // Blade::if('p.delete', function ($value) {
        //     return config('permission.delete') === $value;
        // });
    }
}
