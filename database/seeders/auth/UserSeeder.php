<?php

namespace Database\Seeders\auth;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Michał',
            'last_name' => 'Szczepański',
            'pesel' => '00000000000',
            'email' => 'admin@localhost',
            'phone' => '+48123123123',
            'password' => Hash::make('root12')
        ]);

        $role = Role::findByName('super-admin');
        $user->assignRole($role);
    }
}
