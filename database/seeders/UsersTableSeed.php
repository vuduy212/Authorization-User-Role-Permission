<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Role;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $adminRole = Role::where('name', 'admin_test')->first();
        $clientRole = Role::where('name', 'client_test')->first();

        $admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin_test@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        $admin->roles()->attach($adminRole);

        $client = User::create([
            'name' => 'Client Test',
            'email' => 'client_test@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        $client->roles()->attach($clientRole);
    }
}
