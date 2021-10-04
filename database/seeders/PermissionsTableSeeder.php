<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(config('permission_data.permission') as $permission)
        {
            Permission::updateOrCreate(
                ['name' => $permission['name']],
                ['action' => $permission['action']]
            );
        };

        foreach(config('permission_data.user') as $permission)
        {
            Permission::updateOrCreate(
                ['name' => $permission['name']],
                ['action' => $permission['action']]
            );
        }

        foreach(config('permission_data.role') as $permission)
        {
            Permission::updateOrCreate(
                ['name' => $permission['name']],
                ['action' => $permission['action']]
            );
        }
    }
}
