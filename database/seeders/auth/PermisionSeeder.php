<?php

namespace Database\Seeders\auth;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'users.read_one']);
        Permission::create(['name' => 'users.read_all']);

        Permission::create(['name' => 'locations.read_one']);
        Permission::create(['name' => 'locations.read_all']);

        $superAdmin = Role::findByName('super-admin');
        $superAdmin->givePermissionTo(Permission::all());
    }
}
