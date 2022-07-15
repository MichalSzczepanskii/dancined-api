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
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions

        //Users permissions
        Permission::create(['name' => 'users.read_one']);
        Permission::create(['name' => 'users.read_all']);
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.update']);
        Permission::create(['name' => 'users.delete']);

        //Locations permissions
        Permission::create(['name' => 'locations.read_one']);
        Permission::create(['name' => 'locations.read_all']);
        Permission::create(['name' => 'locations.create']);
        Permission::create(['name' => 'locations.update']);
        Permission::create(['name' => 'locations.delete']);


        //Lesson types permissions
        Permission::create(['name' => 'lesson-types.read_one']);
        Permission::create(['name' => 'lesson-types.read_all']);
        Permission::create(['name' => 'lesson-types.create']);
        Permission::create(['name' => 'lesson-types.update']);
        Permission::create(['name' => 'lesson-types.delete']);

        //Rooms permissions
        Permission::create(['name' => 'rooms.read_one']);
        Permission::create(['name' => 'rooms.read_all']);
        Permission::create(['name' => 'rooms.create']);
        Permission::create(['name' => 'rooms.update']);
        Permission::create(['name' => 'rooms.delete']);

        //Clients permissions
        Permission::create(['name' => 'clients.read_one']);
        Permission::create(['name' => 'clients.read_all']);
        Permission::create(['name' => 'clients.create']);
        Permission::create(['name' => 'clients.update']);
        Permission::create(['name' => 'clients.delete']);

        $superAdmin = Role::findByName('super-admin');
        $superAdmin->givePermissionTo(Permission::all());
    }
}
