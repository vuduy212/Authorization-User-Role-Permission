<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/denies', [App\Http\Controllers\HomeController::class, 'denies'])->name('denies');

// Route::resource('/admin/users', UserController::class);
// Route::resource('/admin/roles', RoleController::class);
// Route::resource('/admin/permissions', PermissionController::class);

/*------ Admin ------*/
Route::prefix('admin')->middleware('auth')->group(function () {

    /*------ User ------*/
    Route::prefix('users')->name('users.')->group(function () {
        $class = UserController::class;
        Route::get('/', [$class, 'index'])->name('index');
        Route::get('/create', [$class, 'create'])->name('create')->middleware('hasPermission:user.create');
        Route::post('/', [$class, 'store'])->name('store')->middleware('hasPermission:user.create');
        Route::get('/{user}', [$class, 'show'])->name('show')->middleware('hasPermission:user.view');
        Route::put('/{user}', [$class, 'update'])->name('update')->middleware('hasPermission:user.update');
        Route::delete('/{user}', [$class, 'destroy'])->name('destroy')->middleware('hasPermission:user.delete');
        Route::get('/{user}/edit', [$class, 'edit'])->name('edit')->middleware('hasPermission:user.update');
    });

    /*------ Role ------*/
    Route::prefix('roles')->name('roles.')->group(function () {
        $class = RoleController::class;
        Route::get('/', [$class, 'index'])->name('index');
        Route::get('/create', [$class, 'create'])->name('create')->middleware('hasPermission:role.create');
        Route::post('/', [$class, 'store'])->name('store')->middleware('hasPermission:role.create');
        Route::get('/{role}', [$class, 'show'])->name('show')->middleware('hasPermission:role.view');
        Route::put('/{role}', [$class, 'update'])->name('update')->middleware('hasPermission:role.update');
        Route::delete('/{role}', [$class, 'destroy'])->name('destroy')->middleware('hasPermission:role.delete');
        Route::get('/{role}/edit', [$class, 'edit'])->name('edit')->middleware('hasPermission:role.update');
    });

    /*------ Permission ------*/
    Route::prefix('permissions')->name('permissions.')->group(function () {
        $class = PermissionController::class;
        Route::get('/', [$class, 'index'])->name('index');
        Route::get('/create', [$class, 'create'])->name('create')->middleware('hasPermission:permission.create');
        Route::post('/', [$class, 'store'])->name('store')->middleware('hasPermission:permission.create');
        Route::get('/{permission}', [$class, 'show'])->name('show')->middleware('hasPermission:permission.view');
        Route::put('/{permission}', [$class, 'update'])->name('update')->middleware('hasPermission:permission.update');
        Route::delete('/{permission}', [$class, 'destroy'])->name('destroy')->middleware('hasPermission:permission.delete');
        Route::get('/{permission}/edit', [$class, 'edit'])->name('edit')->middleware('hasPermission:permission.update');
    });
});
