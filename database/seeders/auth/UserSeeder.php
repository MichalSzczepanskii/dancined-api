<?php

namespace Database\Seeders\auth;

use App\Models\Participant;
use App\Models\Person;
use App\Models\User;
use Carbon\Carbon;
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
        $person = Person::create([
            'first_name' => 'Michał',
            'last_name' => 'Szczepański',
            'birth_date' => Carbon::create(1999, 01, 25),
            'pesel' => '00000000000',
            'phone' => '+48123123123',
        ]);
        $user = User::create([
            'email' => 'admin@localhost',
            'password' => Hash::make('root12'),
            'person_id' => $person->id,
        ]);

        Participant::create([
           'person_id' => $person->id,
           'payer_id' => $user->id,
        ]);

        $role = Role::findByName('super-admin');
        $user->assignRole($role);

        $users = User::factory(30)->create();
        $clientRole = Role::findByName('client');
        foreach ($users as $user) {
            $user->assignRole($clientRole);
        }
    }
}
