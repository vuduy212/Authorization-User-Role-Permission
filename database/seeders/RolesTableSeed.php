<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::updateOrCreate(
            ['name' => 'admin'],
        );

        $clientRole = Role::updateOrCreate(
            ['name' => 'client'],
        );

        $adminRole->attachPermissions([1,2,3,4,5,6,7,8,9,10,11,18]);
    }
}
